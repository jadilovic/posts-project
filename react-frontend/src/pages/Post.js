import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import "../App.css";

const Post = () => {
    const { postId } = useParams();
    const [post, setPost] = useState([]);

    useEffect(() => {
        const getPosts = async () => {
            const response = await fetch(
                `http://127.0.0.1:8000/api/post/${postId}`
            );
            const data = await response.json();
            setPost(data);
        };
        getPosts();
    }, [postId]);

    return (
        <div className="post">
            <h3>
                <b>Naslov: </b>
                {post.naslov}
            </h3>
            <p>
                <b>Opis: </b>
                {post.opis}
            </p>
            <p>
                <b>Kontakt: </b>
                {post.kontakt}
            </p>
            <p>
                <b>Cijena: </b>
                {post.cijena}
            </p>
        </div>
    );
};
export default Post;
