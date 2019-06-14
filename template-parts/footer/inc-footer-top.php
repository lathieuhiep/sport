<?php
//Global variable redux
global $sport_options;

$sport_copyright = $sport_options ['sport_footer_copyright_editor'];

?>
<div class="container">
    <div class="footer-top">
        <div class="footer-top__desc">
            <?php
            echo ent2ncr($sport_options ['sport_footer_top_desc']);
            ?>
        </div>
        <div class="footer-top__allstep">
            <div class="footer-top__step1 footer-top__step">
                <div class="img"> <img src="<?php echo esc_url($sport_options ['sport_footer_top_step1_icon']["url"]); ?>" alt="<?php echo esc_html($sport_options ['sport_footer_top_step1_text']); ?>"/></div>
                <div class="content">
                    <span>
                        <?php echo esc_html__('Bước 1:','sport') ?>
                    </span>
                    <p><?php echo esc_html($sport_options ['sport_footer_top_step1_text']); ?></p>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>

            <div class="footer-top__step2 footer-top__step">
                <div class="img"><img src="<?php echo esc_url($sport_options ['sport_footer_top_step2_icon']["url"]); ?>" alt="<?php echo esc_html($sport_options ['sport_footer_top_step2_text']); ?>"/></div>
                <div class="content">
                    <span>
                        <?php echo esc_html__('Bước 2:','sport') ?>
                    </span>
                    <p><?php echo esc_html($sport_options ['sport_footer_top_step2_text']); ?></p>
                </div>
                <i class="fas fa-arrow-circle-right"></i>
            </div>

            <div class="footer-top__step3 footer-top__step">
                <div class="img">
                    <div class="img"><img src="<?php echo esc_url($sport_options ['sport_footer_top_step3_icon']["url"]); ?>" alt="<?php echo esc_html($sport_options ['sport_footer_top_step3_text']); ?>"/></div>
                </div>
                <div class="content">
                    <span>
                        <?php echo esc_html__('Bước 3:','sport') ?>
                    </span>
                    <p><?php echo esc_html($sport_options ['sport_footer_top_step3_text']); ?></p>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>

            <div class="footer-top__step4 footer-top__step">
                <div class="img"><img src="<?php echo esc_url($sport_options ['sport_footer_top_step4_icon']["url"]); ?>" alt="<?php echo esc_html($sport_options ['sport_footer_top_step4_text']); ?>"/></div>
                <div class="content">
                    <span>
                        <?php echo esc_html__('Bước 4:','sport') ?>
                    </span>
                    <p><?php echo esc_html($sport_options ['sport_footer_top_step4_text']); ?></p>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>

            <div class="footer-top__step5 footer-top__step">
                <div class="img"><img src="<?php echo esc_url($sport_options ['sport_footer_top_step5_icon']["url"]); ?>" alt="<?php echo esc_html($sport_options ['sport_footer_top_step5_text']); ?>"/></div>
                <div class="content">
                    <span>
                        <?php echo esc_html__('Bước 5:','sport') ?>
                    </span>
                    <p><?php echo esc_html($sport_options ['sport_footer_top_step5_text']); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
