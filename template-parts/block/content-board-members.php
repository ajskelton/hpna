<?php

$board_members = get_field( 'board_members' );
?>
<div class="hpna-board-members">

    <?php foreach( $board_members as $member ) : ?>
        <div class="hpna-board-members__member">
            <div class="hpna-board-members__member-photo">
                <?php echo wp_get_attachment_image( $member['photo']['ID'], 'thumbnail' ); ?>
            </div>
            <div class="hpna-board-members__member-content">
                <p class="hpna-board-members__name-and-title"><?php echo sprintf( '%s, %s', esc_html( $member['name'] ), esc_html( $member['title']) ); ?></p>
                <?php if ( $member['bio'] ) : ?>
                    <p class="hpna-board-members__bio"><?php echo esc_html( $member['bio'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    
</div>
