import { useEffect, useState } from "react";
import "../App.css";
import { Link } from "react-router-dom";

const Home = () => {
    const [posts, setPosts] = useState([]);

    useEffect(() => {
        const getPosts = async () => {
            const response = await fetch("http://127.0.0.1:8000/api/posts");
            const data = await response.json();
            setPosts(data);
        };
        getPosts();
    }, []);

    return (
        <div className="App">
            <header className="App-header">
                <h1>Get posts</h1>
                {posts.length > 0
                    ? posts.map((post) => {
                          return (
                              <section key={post.id}>
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
                                  <Link to={`/post/${post.id}`}>
                                      Pogledaj detaljno
                                  </Link>
                              </section>
                          );
                      })
                    : null}
            </header>
        </div>
    );
};
export default Home;
