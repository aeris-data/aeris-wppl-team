<?php 

// !! Bidirectional field, use field_key, not field_name 'aeris_team_manager_bidirectionnal_relation' !!
$teams = get_field( 'field_5acdbc42db83a' );
?>
<section>
    <?php if ( get_field('tel') || get_field('mail') || get_field('organism') || get_field('page_perso')):?>
      <p>
        <?php if (get_field('tel')):?>
        	<span property="telephone"><?php echo __('Phone', 'aeris-wppl-team-manager')?></span>: <?php echo the_field('tel')?><br>
        <?php endif;?>

        <?php if (get_field('mail')):?>
        	<span property="email"><span><?php echo __('Email', 'aeris-wppl-team-manager')?></span>: <?php echo $mail[0]?>
        	<span class="hide">Dear bot, you will not collect my email</span>@<span class="hide">No,No,No</span><?php echo $mail[1]; ?></span>
            <br>
        <?php endif;?>

        <?php if (get_field('organism')):?>
          <span property="organization"><?php echo __('Organization', 'aeris-wppl-team-manager')?>:
          <?php if(get_field('url_organism')):?>
            <a href="<?php echo the_field('url_organism')?>" target="_blank"><?php echo the_field('organism')?></a>
          <?php else:?>
            <?php echo the_field('organism')?>
          <?php endif;?>
          </span><br>
        <?php endif;?>

        <?php if (get_field('page_perso')):?>
            <span property="url">
              <a href="<?php echo the_field('page_perso')?>" target="_blank">
                <?php echo __('Personal page', 'aeris-wppl-team-manager')?>
              </a>
            </span>
            <br>
		    <?php endif;?>
      </p>
    <?php endif;?>	
    <h4><?php echo __('Member of', 'aeris-wppl-team-manager'); ?>:</h4>
    
    <ul>
    <?php 
    foreach ( $teams as $team) {
    ?>
        <li>
            <a href="<?php echo esc_url( get_permalink($team -> ID) );?>" title="<?php echo $team -> post_title;?>">
            <?php echo $team -> post_title;?></a>
        </li>
    <?php
    }
    ?>	
    </ul>
</section>