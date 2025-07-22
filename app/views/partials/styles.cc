/* Modern glossy semi-transparent search bar */
.search-bar {
  width: 100%;
  max-width: 600px;
  margin: 20px auto;
  display: flex;
  background: rgba(255, 255, 255, 0.7); /* semi-transparent white */
  border-radius: 30px;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  border: 1px solid rgba(255, 255, 255, 0.18);
  padding: 5px 15px;
}

.search-bar input[type="text"] {
  flex-grow: 1;
  border: none;
  outline: none;
  padding: 12px 20px;
  font-size: 1.1rem;
  border-radius: 30px 0 0 30px;
  background: transparent;
  color: #333;
  font-weight: 600;
}

.search-bar input[type="text"]::placeholder {
  color: #aaa;
  font-style: italic;
}

.search-bar button {
  border: none;
  background: #007bff;
  color: white;
  padding: 0 25px;
  font-size: 1.2rem;
  border-radius: 0 30px 30px 0;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-bar button:hover {
  background: #0056b3;
}

/* Movie list styling */
.movie-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 20px;
  padding: 0;
  margin-top: 40px;
}

.movie-card {
  background: rgba(255, 255, 255, 0.85);
  border-radius: 15px;
  box-shadow: 0 4px 8px rgb(0 0 0 / 0.1);
  overflow: hidden;
  transition: transform 0.25s ease;
  cursor: pointer;
}

.movie-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.movie-poster {
  width: 100%;
  height: 240px;
  object-fit: cover;
  border-bottom: 1px solid #ddd;
}

.movie-info {
  padding: 12px;
  text-align: center;
}

.movie-title {
  font-weight: 700;
  font-size: 1.1rem;
  color: #007bff;
  margin-bottom: 6px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.movie-year {
  color: #666;
  font-size: 0.9rem;
}
