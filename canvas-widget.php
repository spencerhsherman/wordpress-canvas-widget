<?php
/*
Plugin Name: Canvas Widget
Plugin URI: http://3thoughtcreative.com
Description: A simple, canvas widget plugin for Wordpress that can be adapted for many different purposes.
Version: 1.0
Author: Spencer Sherman
Author URI: http://shermanluiggi.com/
License: GPL2
*/
class canvas_widget_plugin extends WP_Widget {

// constructor
function canvas_widget_plugin() {
parent::WP_Widget(false, $name = __('Canvas Widget', 'canvas_widget_plugin') );
}

// widget form creation
function form($instance) { 
// Check values
if( $instance) { 
     $title = esc_attr($instance['title']); 
     $text = esc_attr($instance['text']); 
     $textarea = esc_textarea($instance['textarea']); 
     $checkbox = esc_attr($instance['checkbox']);
	 $select = esc_attr($instance['select']);
} else { 
     $title = '';
     $text = '';
     $textarea = '';
     $checkbox = '';
	 $select = '';
}
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'canvas_widget_plugin'); ?></label>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'canvas_widget_plugin'); ?></label>
<input id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'canvas_widget_plugin'); ?></label>
<textarea id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
</p>
<p>
<input id="<?php echo $this->get_field_id('checkbox'); ?>" name="<?php echo $this->get_field_name('checkbox'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
<label for="<?php echo $this->get_field_id('checkbox'); ?>"><?php _e('Checkbox', 'canvas_widget_plugin'); ?></label>
</p>
<p>
<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Select', 'canvas_widget_plugin'); ?></label>
<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
<?php
$options = array('lorem', 'ipsum', 'dolorem');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select>
</p>
<?php }

// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['text'] = strip_tags($new_instance['text']);
      $instance['textarea'] = strip_tags($new_instance['textarea']);
      $instance['checkbox'] = strip_tags($new_instance['checkbox']);
	  $instance['select'] = strip_tags($new_instance['select']);
     return $instance;
}

// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $text = $instance['text'];
   $textarea = $instance['textarea'];
   $checkbox = $instance['checkbox'];
   $select = $instance['select'];
   echo $before_widget;
   // Display the widget
   echo '<div>';

   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }

   // Check if text is set
   if( $text ) {
      echo '<p>'.$text.'</p>';
   }
   // Check if textarea is set
   if( $textarea ) {
     echo '<p>'.$textarea.'</p>';
   }
   // Check if checkbox is checked
   if( $checkbox AND $checkbox == '1' ) {
     echo '<p>'.__('Checkbox is checked', 'canvas_widget_plugin').'</p>';
   }
   // Get $select value
	if ( $select == 'lorem' ) {
		echo 'Lorem option is Selected';
		} else if ( $select == 'ipsum' ) {
		echo 'ipsum option is Selected';
		} else {
		echo 'dolorem option is Selected';
	}
   echo '</div>';
   echo $after_widget;
}
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("canvas_widget_plugin");'));
?>
