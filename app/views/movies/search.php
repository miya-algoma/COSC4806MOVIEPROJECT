<!DOCTYPE html>
<html>
<head>
    <title>Movie Search</title>
</head>
<body>
    <h1>Search Movie by Title (Example)</h1>
    <form method="GET" action="https://www.omdbapi.com/">
        <input type="text" name="t" placeholder="Movie title" required />
        <input type="hidden" name="apikey" value="YOUR_OMDB_API_KEY" />
        <button type="submit">Search</button>
    </form>
    <p>Note: Search results handled externally (OMDB API). Click a movie and then add rating here after saving.</p>
</body>
</html>
