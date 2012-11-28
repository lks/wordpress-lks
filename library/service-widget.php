<?php 

/**
* Widget to display my last service. This widget is concepted with responsive design constraints.
* @author lks
*
*/
class MyLastServices extends WP_Widget {
 
    public $number_column_ref;
    /**
    * Constructor
    */
    function MyLastServices()
    {
        $this->number_column_ref = array(1=>"twelve",
                        2=> "six",
                        3=> "four",
                        4=> "three");
        parent::WP_Widget(false, $name = 'Mes derniers services', array('name' => 'Mes derniers services', 'description' => 'Affichage des derniers articles du blog'));
    }
 
    /**
    * Display the widget with the settings parameters
    */
    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $nb_posts = $instance['nb_posts'];
        $nb_str = $instance['nb_str'];

        $lastposts = get_posts(array('post_type'=>"service_post_type", 'numberposts'=>$nb_posts));
     
        //display items
        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        else
            echo $before_title . 'My last services' . $after_title;
        echo '<ul class="listing-item">';
        $i = 0;

        if(!(isset($nb_str) && $nb_str > 0)) {
            $nb_str = 130;
        }

        foreach ( $lastposts as $post ) : 
            setup_postdata($post); 

            //manage the padding settings
            $class_option = "";
            if($i == 0) {
                $class_option = "first"; 
            } else if (($i)%$nb_posts == ($nb_posts-1)) {
                $class_option = "last"; 
            } ?>

            <li class="<?php echo $this->number_column_ref[$nb_posts]; ?> columns <?php echo $class_option; ?>">
                <?php echo $this->manageThumbnail($post->ID); ?>
                <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                <p><?php echo substr($post->post_excerpt, 0, $nb_str)."..."; ?></p>
                <p><a href="<?php get_permalink($post->ID); ?>">Read more »</a></p>
            </li>
        <?php 
         $i++;
        endforeach;
        echo '</ul>';
        echo $after_widget;
    }
 
    /**
    * Update parameters of this widget
    */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
 
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['nb_posts'] = $new_instance['nb_posts'];
        $instance['nb_str'] = $new_instance['nb_str'];
 
        return $instance;
    }
 
    /**
    * Form to get parameters
    */
    function form($instance)
    {
        $title = esc_attr($instance['title']);
        $nb_posts = esc_attr($instance['nb_posts']);
        $nb_str = esc_attr($instance['nb_str']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo 'Titre:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('nb_posts'); ?>">
                <?php echo 'Nombre d\'articles:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('nb_posts'); ?>" name="<?php echo $this->get_field_name('nb_posts'); ?>" type="text" value="<?php echo $nb_posts; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('nb_str'); ?>">
                <?php echo 'Nombre de caractère (par défaut à 130 caratères) :'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('nb_str'); ?>" name="<?php echo $this->get_field_name('nb_str'); ?>" type="text" value="<?php echo $nb_str; ?>" />
            </label>
        </p>
    <?php
    }

    /**
    * Manage the display of a thumbnail. 
    * If there aren't thumbnail, I display a generic picture.
    *
    * @param $ID Id of post to display.
    */
    function manageThumbnail($ID) {
        $thumbnail = get_the_post_thumbnail($ID, 'post-service-size');
        if("" == $thumbnail) {
            $thumbnail =  "<div class='generic-bloc'></div>";
        }
        return $thumbnail;
    }
}
 
function dfr_register_widget() {
    register_widget( 'MyLastServices' );
}
add_action('widgets_init', 'dfr_register_widget');

?>