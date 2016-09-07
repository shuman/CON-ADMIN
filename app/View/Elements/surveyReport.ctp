<div class="sec_row">
	<div class="border_left_arrow">
		<a href="javascript:;" id="viewAll">View All Surveys</a>
	</div>
</div><!-- /sec_row -->

<div class="sec_row">
	<div class="sec_title">
		<h2><?php echo $survey['Survey']['name'] ? $survey['Survey']['name'] : 'N/A'; ?> Report</h2>
	</div>
	<div class="input_block">
		<div class="btn_file export_csv">
			<?php echo $this->Html->link('Export reports as csv file',array('controller'=>'conference','action'=>'suexport', $survey['Survey']['survey_id']), array('target'=>'_blank', 'class' => 'button'));?>
		</div>
	</div>
</div><!-- /sec_row -->
<div class="sec_row">
	<?php if (!empty($survey)): ?>
		<?php foreach ($survey['Question'] as $eachQuestion): ?>
			<?php if ($eachQuestion['type'] == 0): ?>
				<div class="report_box">
					<div class="report_title">
						<span class="report_no">1</span>
						<?php echo $eachQuestion['question'];?>
					</div>
					<?php if (!empty($eachQuestion['PresetAnswer'])): ?>
						<?php foreach ($eachQuestion['PresetAnswer'] as $eachAnswer): ?>
							<div class="input_block">
								<div class="report_row rpt_pink">
									<span class="type_sl">A</span>
									<div class="prc_block">
										<span class="report_lavel" style="width: <?php echo $eachAnswer['total'] > 0 ? ($eachAnswer['answered'] * 100)/$eachAnswer['total'] : 0;?>%;"></span>
									</div>
									<span class="label_percent"><?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['answered'] * 100)/$eachAnswer['total']) : 0;?>%</span>
								</div><!-- /report_row -->
								<div class="report_desc">
									<p><?php echo $eachAnswer['answer'] ? $eachAnswer['answer'] : 'N/A';?></p>
								</div>
							</div>
						<?php endforeach;?>
					<?php endif;?>

				</div><!-- /report_box -->
			<?php elseif($eachQuestion['type'] == 1): ?>
				<div class="report_box">
					<div class="report_title">
						<span class="report_no">2</span>
						<?php echo $eachQuestion['question'];?>
					</div>

					<div class="input_block">
						<div class="report_row rpt_pink">
							<span class="type_sl">Y</span>
							<div class="prc_block">
								<span class="report_lavel" style="width: <?php echo round(($eachAnswer['yes'] * 100)/$eachAnswer['total']);?>%;"></span>
							</div>
							<span class="label_percent"><?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['yes'] * 100)/$eachAnswer['total']) : 0;?>%</span>
						</div><!-- /report_row -->
						<div class="report_desc">
							<p>Yes</p>
						</div>
					</div>

					<div class="input_block">
						<div class="report_row rpt_sky_blue">
							<span class="type_sl">N</span>
							<div class="prc_block">
								<span class="report_lavel" style="width: <?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['no'] * 100)/$eachAnswer['total']) : 0;?>%;"></span>
							</div>
							<span class="label_percent"><?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['no'] * 100)/$eachAnswer['total']) : 0;?>%</span>
						</div><!-- /report_row -->
						<div class="report_desc">
							<p>No</p>
						</div>
					</div>
				</div><!-- /report_box -->
			<?php elseif($eachQuestion['type'] == 2): ?>
				<div class="report_box">
					<div class="report_title">
						<span class="report_no">3</span>
						<?php echo $eachQuestion['question'];?>
					</div>

					<div class="input_block">
						<div class="report_row rpt_pink">
							<span class="type_sl">T</span>
							<div class="prc_block">
								<span class="report_lavel" style="width: <?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['true'] * 100)/$eachAnswer['total']) : 0;?>%;"></span>
							</div>
							<span class="label_percent"><?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['true'] * 100)/$eachAnswer['total']) : 0;?>%</span>
						</div><!-- /report_row -->
						<div class="report_desc">
							<p>True</p>
						</div>
					</div>

					<div class="input_block">
						<div class="report_row rpt_sky_blue">
							<span class="type_sl">F</span>
							<div class="prc_block">
								<span class="report_lavel" style="width: <?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['false'] * 100)/$eachAnswer['total']) : 0;?>%;"></span>
							</div>
							<span class="label_percent"><?php echo $eachAnswer['total'] > 0 ? round(($eachAnswer['false'] * 100)/$eachAnswer['total']) : 0;?>%</span>
						</div><!-- /report_row -->
						<div class="report_desc">
							<p>False</p>
						</div>
					</div>
				</div><!-- /report_box -->
			<?php else: ?>
				<!-- <div class="report_box">
					<div class="report_title">
						<span class="report_no">4</span>
						Vestibulum rutrum quam vitae fringilla tincidunt. Suspendisse nec tortor urna. Ut laoreet sodales nisi?
					</div>

					<div class="input_block">
						<div class="rpt_pl10">
							<p>Statistics for short answer questions are avaialbe in CSV file.</p>
						</div>
					</div>
				</div> --><!-- /report_box -->
		<?php endif;?>
		<?php endforeach;?>
	<?php endif; ?>

	<div class="input_block">
		<div class="btn_file export_csv">
			<?php echo $this->Html->link('Export reports as csv file',array('controller'=>'conference','action'=>'suexport', $survey['Survey']['survey_id']), array('target'=>'_blank', 'class' => 'button'));?>
		</div>
	</div>

</div><!-- /sec_row -->