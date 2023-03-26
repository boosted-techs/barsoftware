<?php

class ItemsController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->user_model = new Users_model();
        $this->items_model = new Items_model();
        $this->rooms_model = new Rooms_model();
    }

    function index() {
        $this->user_model->check_login();
        $items  = $this->items_model->get_items();
        $this->view->render("items/items", ['items' => $items]);
    }

    function add_item() {
        $this->user_model->check_login();
        if ($this->user_model->is_admin()) {
            $this->view->render("items/add_item");
        }
    }

    public function save_item() {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            echo "Not allowed"; exit;
        }
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $qty = $_POST['qty'];

        $item_data = array(
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'stock_level' => $qty,
            "_type" => $category == 1 ? 1 : 2,
            'image' => self::create_image($name)
        );
        if ($category == 1) {
            $item = $this->items_model->insert_item($item_data);
            if ($item)
                $message = "Item successfully added";
            else
                $message = "Item not added";
            $this->redirect_with_error("/items", $message);
        } else {
            $room = $this->rooms_model->insert_room($item_data);
            if ($room)
                $message = "Room successfully added";
            else
                $message = "Room not added";
            $this->redirect_with_error("/items/rooms", $message);
        }
    }

    function rooms() {
        $this->user_model->check_login();
        $items  = $this->rooms_model->get_rooms();
        $this->view->render("items/rooms", ['items' => $items]);
    }

    function create_image($text) {
        // Set the string to be used in the image
        // Set the image width and height
        $width = 900;
        $height = 900;

        // Create a new image resource
        $image = imagecreatetruecolor($width, $height);

        // Set the background color
        $bg_color = imagecolorallocate($image, 238, 238, 238);
        imagefill($image, 0, 0, $bg_color);

        // Set the font color
        $font_color = imagecolorallocate($image, 0, 0, 0);

        // Set the font path and size
        $font_path = __DIR__ .'/font.ttf';
        $font_size = 100;

        // Calculate the text box dimensions
        $text_box = imagettfbbox($font_size, 0, $font_path, $text);
        $text_width = $text_box[2] - $text_box[0];
        $text_height = $text_box[3] - $text_box[5];

        // Calculate the text position and margins
        $x = ceil(round(($width - $text_width) / 2));
        $y = round(($height - $text_height) / 2);
        $left_margin = $x;

        // Wrap the text
        $wrapped_text = wordwrap($text, 40, "\n");

        // Write the text to the image
        imagettftext($image, $font_size, 0, abs($x), $y, $font_color, $font_path, $wrapped_text);

        // Generate a hashed filename
        $filename = md5($text . time()) . '.png';

        // Save the image to the media folder with high quality
        imagepng($image, 'media/' . $filename, 9);

        // Free up memory
        imagedestroy($image);

        // Output the image
        return $filename;
    }

    function edit_item($item) {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            echo "Not allowed"; exit;
        }
        $items  = $this->items_model->get_items(item : $item);
        $this->view->render("items/edit_item", ['item' => $items]);
    }

    function save_edit() {
        $this->user_model->check_login();
        if (! $this->user_model->is_admin()) {
            echo "Not allowed"; exit;
        }
        $this->items_model->update_item();
    }

    function book($room) {
        $this->user_model->check_login();
        $this->rooms_model->reserve_room($room, $_GET['status']);
        $this->redirect_with_error("/items/rooms", "Successfully updated record");
    }
}