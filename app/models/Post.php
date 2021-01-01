<?php
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts()
    {
        // Get all posts 
        $query = "SELECT *,
            posts.post_id as postId,
            users.user_id as userId 
            FROM posts
            INNER JOIN users 
            ON posts.user_id = users.user_id 
            ORDER BY posts.created_at DESC ";
        $this->db->query($query);

        $res = $this->db->resultSet();

        return $res;
    }

    public function addPost($data)
    {
        $query = "INSERT INTO posts(user_id,post_title,post_body) VALUES (:user_id,:title,:body) ";
        $this->db->query($query);
        // Bind values to query
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function  getPostById($id)
    {
        $query = "SELECT * FROM posts where post_id = :id";
        $this->db->query($query);
        $this->db->bind(":id", $id);

        $res = $this->db->single();

        return $res;
    }


    public function updatePost($data)
    {
        $query = "UPDATE posts
        SET 
            post_title= :title, 
            post_body= :body
        WHERE  post_id= :id ";
        $this->db->query($query);
        // Bind values to query
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $data['id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        $query = "DELETE FROM posts  WHERE post_id= :id ";
        $this->db->query($query);
        $this->db->bind(":id", $id);
        if ($this->db->execute())
            return true;
        else
            return  false;
    }
}
