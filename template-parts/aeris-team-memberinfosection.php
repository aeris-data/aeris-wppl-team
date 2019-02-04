<?php 

// !! Bidirectional field, use field_key, not field_name 'aeris_team_manager_bidirectionnal_relation' !!
$teams = get_field( 'field_5acdbc42db83a' );
?>
<section>
    <?php if ( get_field('tel') || get_field('mail') || get_field('organism') || get_field('page_perso')):?>
      <p>
        <?php if (get_field('tel')):?>
        	<label><?=esc_html('Phone', 'aeris-wppl-team-manager')?></label>: <?=the_field('tel')?><br />
        <?php endif;?>
        <?php if (get_field('mail')):?>
        	<label><?=esc_html('Email', 'aeris-wppl-team-manager')?></label>: <?=$mail[0]?>
        	<span class="hide">Dear bot, you will not collect my email</span>@<span class="hide">No,No,No</span><?php echo $mail[1]; ?>
            <br />
        <?php endif;?>
        <?php if (get_field('organism')):?>
		   <label><?=esc_html('Organization')?></label>:
		   <?php if(get_field('url_organism')):?>
		     <a href="<?=get_field('url_organism')?>" target="_blank"><?=get_field('organism')?></a>
		   <?php else:?>
		     <?=get_field('organism')?>
		   <?php endif;?>
		   <br />
		<?php endif;?>
            <?php if (get_field('page_perso')):?>
            <label><?=esc_html('Personal page', 'aeris-wppl-team-manager')?></label>:
            <a href="<?=get_field('page_perso')?>" target="_blank">
            <?=get_field('lastname')?> <?=get_field('firstname')?> 
			</a><br />
		<?php endif;?>
      </p>
    <?php endif;?>	
    <h4><?php esc_html_e('Member of', 'aeris-wppl-team-manager'); ?>:</h4>
    <ul>
    <?php 
    foreach ( $teams as $team) {
    ?>	
        <li>
            <a href="<?php echo $team -> guid;?>" title="<?php echo $team -> post_title;?>">
            <?php echo $team -> post_title;?></a>
        </li>
    <?php
    }
    ?>	
    </ul>
</section>