import { BrowserRouter as Router, Route, Link, Routes } from "react-router-dom";
import Home from "./pages/Home";
import Post from "./pages/Post";
import "./App.css";

function App() {
    return (
        <Router>
            <div>
                <nav>
                    <ul className="navbar">
                        <li>
                            <Link to="/">Home</Link>
                        </li>
                    </ul>
                </nav>
                <Routes>
                    <Route exact path="/" element={<Home />} />
                    <Route path="/post/:postId" element={<Post />} />
                </Routes>
            </div>
        </Router>
    );
}

export default App;
