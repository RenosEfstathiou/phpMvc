<?php
class Posts extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect("users/login");
        }

        $this->postModel = $this->model("Post");
    }

    public function  index()
    {
        $posts = $this->postModel->getPosts();
        $data = ["posts" => $posts];

        $this->view('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post array

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "title" => trim($_POST['title']),
                "body" => trim($_POST['body']),
                "user_id" => $_SESSION['user_id'],
                "title_err" => '',
                "body_err" => ''
            ];

            // Validate title
            if (empty($data['title'])) {
                $data['title_err'] = "Please enter a title";
            }
            // Validate body
            if (empty($data['body'])) {
                $data['body_err'] = "Please enter a body";
            }

            // Make sure there are no errors

            if (empty($data["body_err"]) && empty($data['title_err'])) {

                // Validated 

                if ($this->postModel->addPost($data)) {
                    flash('post_added', "Post created successfully");
                    redirect("posts");
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view("posts/add", $data);
            }
        } else {

            $data = [
                "title" => '',
                "body" => '',
                "title_err" => '',
                "body_err" => ""
            ];

            $this->view('posts/add', $data);
        }
    }
}
