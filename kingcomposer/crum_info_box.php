<?php
/** @var array $atts */
$title         = $desc          = $icon          = $image         = $button        = $btn_color     = $link_button   = $position      = $show_link     = $link          = $custom_class  = $data_img      = $data_icon     = $data_title    = $data_desc     = $data_position = $media         = '';
$layout        = 'standard';
$wrap_class    = apply_filters( 'kc-el-class', $atts );

global $allowedtags;
extract( $atts );
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-info-box';
$wrap_class[] = 'info-box--' . $layout;

if ( !empty( $custom_class ) ) {
    $wrap_class[] = $custom_class;
}

$img_width  = 70;
$img_height = 70;

$button_link   = kc_parse_link( $link );
$button_href   = !empty( $button_link[ 'url' ] ) ? esc_url( $button_link[ 'url' ] ) : '#';
$button_target = !empty( $button_link[ 'target' ] ) ? esc_attr( $button_link[ 'target' ] ) : '_self';
$button_title  = !empty( $button_link[ 'title' ] ) ? esc_attr( $button_link[ 'title' ] ) : esc_html__( 'Read More', 'utouch' );

if ( 'classic' === $layout ) {
    $img_width  = $img_height = 60;
}
if ( 'standard-nofloat' === $layout ) {
    $img_width  = $img_height = 40;
}

if ( 'yes' === $link_button ) {
    $btn_class = array( 'btn', ' btn--with-shadow' );
    if ( 'yes' == $outlined ) {
        $btn_class[] = 'btn-border';
    }
    $btn_class[] = 'btn-' . esc_attr( $btn_size );

    $btn_color   = empty( $btn_color ) ? 'primary' : $btn_color;
    $btn_class[] = 'btn--' . esc_attr( $btn_color );

    $button .= '<a href="' . $button_href . '" target="' . $button_target . '" title="' . $button_title . '"';
    $button .= 'class="' . esc_attr( implode( ' ', $btn_class ) ) . '" >';
    $button .= '<span class="text">' . esc_html( $button_title ) . ' </span>';
    $button .= '</a>';
} else {
    $button = '';
}

if ( 'image' === $media && $image > 0 ) {
    $img_link = wp_get_attachment_image( $image, 'full', false, $atts     = array( 'width' => $img_width, 'height' => $img_height, 'title'	=> get_the_title($image) ) );
    $data_img .= $img_link;
} else {
    if ( empty( $icon ) || $icon == '__empty__' ) {
        $icon = 'et-trophy';
    }

    $data_img .= '<i class="' . $icon . '"></i>';
}

if ( 'standard-hover' === $layout ) {
    ?>
    <div class="<?php echo implode( ' ', $wrap_class ); ?>">

        <div class="info-box-image">
            <?php echo( $data_img ); ?>
        </div>

        <div class="info-box-content">
            <?php
            $title_atts = array(
                'class' => 'h5 info-box-title'
            );
            if ( 'yes' === $show_link ) {
                $title_atts[ 'href' ]   = $button_href;
                $title_atts[ 'target' ] = $button_target;
                $title_tag              = 'a';
                $before_title           = '<h5>';
                $after_title            = '</h5>';
            } else {
                $title_tag    = 'h5';
                $before_title = '';
                $after_title  = '';
            }
            echo ($before_title . utouch_html_tag( $title_tag, $title_atts, $title ) . $after_title);
            ?>

            <div class="info-box-text"><?php echo esc_html( $desc ) ?></div>
        </div>

        <?php
        if ( $button && 'yes' === $show_link ) {
            echo ($button);
        } else if ( 'yes' === $show_link ) {
            ?>
            <a href="<?php echo( isset( $button_href ) ? $button_href : '' ) ?>" target="<?php echo esc_attr( $button_target ); ?>" class="btn-next">
                <svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
                <use xlink:href="#utouch-icon-arrow-right-1"></use>
                </svg>
                <svg class="utouch-icon utouch-icon-arrow-right1">
                <use xlink:href="#utouch-icon-arrow-right1"></use>
                </svg>
            </a>
        <?php } ?>

    </div>

    <?php
} elseif ( 'classic' === $layout ) {
    ?>
    <div class="<?php echo implode( ' ', $wrap_class ); ?>" data-mh="box--classic">

        <div class="info-box-image">
            <?php echo( $data_img ); ?>
        </div>

        <div class="info-box-content">
            <?php
            $title_atts = array(
                'class' => 'h5 info-box-title'
            );
            if ( 'yes' === $show_link ) {
                $title_atts[ 'href' ]   = $button_href;
                $title_atts[ 'target' ] = $button_target;
                $title_tag              = 'a';
                $before_title           = '<h5>';
                $after_title            = '</h5>';
            } else {
                $title_tag    = 'h5';
                $before_title = '';
                $after_title  = '';
            }
            echo ($before_title . utouch_html_tag( $title_tag, $title_atts, $title ) . $after_title);
            ?>
            <div class="info-box-text">
                <p><?php echo esc_html( $desc ) ?></p>
                <?php echo ($button); ?>
            </div>
        </div>
    </div>
    <?php
} elseif ( 'standard-nofloat' === $layout ) {
    $wrap_class[] = 'info-box--standard';
    ?>
    <div class="<?php echo implode( ' ', $wrap_class ); ?>">
        <div class="info-box-image display-flex">
            <div class="icon-small info-box-image"><?php echo( $data_img ); ?></div>
            <?php
            $title_atts   = array(
                'class' => 'h6 info-box-title'
            );
            if ( 'yes' === $show_link ) {
                $title_atts[ 'href' ]   = $button_href;
                $title_atts[ 'target' ] = $button_target;
                $title_tag              = 'a';
                $before_title           = '<h5>';
                $after_title            = '</h5>';
            } else {
                $title_tag    = 'h6';
                $before_title = '';
                $after_title  = '';
            }
            echo ($before_title . utouch_html_tag( $title_tag, $title_atts, $title ) . $after_title);
            ?>

        </div>
        <div class="info-box-text">
            <p><?php echo esc_html( $desc ) ?></p>
            <?php echo ($button); ?>
        </div>

    </div>
    <?php
} elseif ( 'number' === $layout ) {
    ?>
    <div class="crumina-module crumina-info-box info-box--numbers">
        <h5 class="order-number"><?php echo esc_html( $box_number ) ?></h5>
        <?php
        $title_atts = array(
            'class' => 'h3 info-box-title'
        );
        if ( 'yes' === $show_link ) {
            $title_atts[ 'href' ]   = $button_href;
            $title_atts[ 'target' ] = $button_target;
            $title_tag              = 'a';
            $before_title           = '<h5>';
            $after_title            = '</h5>';
        } else {
            $title_tag    = 'h3';
            $before_title = '';
            $after_title  = '';
        }
        echo ($before_title . utouch_html_tag( $title_tag, $title_atts, $title ) . $after_title);
        ?>
        <div class="info-box-text">
            <p><?php echo esc_html( $desc ) ?></p>
            <?php echo ($button); ?>
        </div>

    </div>
    <?php
}
