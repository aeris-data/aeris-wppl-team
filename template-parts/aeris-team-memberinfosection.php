<?php 

// !! Bidirectional field, use field_key, not field_name 'aeris_team_manager_bidirectionnal_relation' !!
$teams = get_field( 'field_5acdbc42db83a' );
?>
<section>
    <?php if ( get_field('tel') || get_field('mail') ) { ?>
    <p>
        Tel : <?php the_field( 'tel' ); ?><br>
        Mail : <?php echo $mail[0]; ?><span class="hide">Dear bot, you will not collect my email</span>@<span class="hide">No,No,No</span><?php echo $mail[1]; ?>
    </p>
    <?php } ?>	
    <h4>Member of :</h4>
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