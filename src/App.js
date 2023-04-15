import React,{useEffect,useState} from "react";
import Recipe from "./Recipe";
import "./App.css";
const App = () => {
  const APP_ID = "6da706c0" ;
  const APP_KEY = "0e4be52412e0bab80226ed7e06a51601";



  const [recipes, setRecipes] = useState([]);
  const [search, setSearch] = useState("");
  const [query, setQuery] = useState('');



 useEffect(() => {
  getRecipes();
  
}, [query]);

const getRecipes = async () => {
  const response = await fetch(
    `https://api.edamam.com/search?q=${query}&app_id=${APP_ID}&app_key=${APP_KEY}`);
  const data = await response.json();
  setRecipes(data.hits); 
  console.log(data.hits);
};

const updateSearch = e => {
  setSearch(e.target.value);
  

};

const getSearch = e => {
  e.preventDefault();
  setQuery(search);
  setSearch('');

}
 
  return(
    <div className="App">
    <h1><center>FOOD HUB</center></h1>
      <form onSubmit={getSearch} className="search-form">
        <input className="search-bar" type="text" value={search} onChange={updateSearch} />
        <button className="search-button" type="submit">Search</button>
      </form>
      <div className="recipes">
      {recipes.map(recipe => (
        
        <Recipe
        
        
        key = {recipe.recipe.label} 
        title = {recipe.recipe.label} 
        calories = {recipe.recipe.calories}
        image= {recipe.recipe.image} 
        ingredients= {recipe.recipe.ingredients} 
        /> 
        ))}
      </div>
      <br></br>
      <br></br>
      <br></br>
      




      <center>
      
      <p>Made with ❤ by Nagavarshini</p></center>
      
    </div>
    );

};
export default App;