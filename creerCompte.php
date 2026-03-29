<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <lang ="en">
    <title>Book Exchanges</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="messages.css">
    <link rel="stylesheet" href="codeHTML.css">
    <link rel="stylesheet" href="marketPlace.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .texte-Teal{
            color: #0e665e;
            font-family: "Helvetica Neue";

        }
         .form-label {
            color: #2C3E50;
        }
        .form-control {
            border: 1px solid #0e6b5e;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }
         .form-check-label {
            color: #2C3E50;
        }
        .exchanges{
            flex-grow: 1;
            margin-left: 300px;  
            background: linear-gradient(135deg, #ecebea, #fffefc); 
            width: calc(100% - 300px);
        }
        .vert-profond {
            background-color: #3b5d50; 
        }
        .btn-teal {
                background-color: #0e6b5e !important;
                color: white !important;
                border-color: #0e6b5e !important;
            }
        .btn-outline-teal {
                border-color: #0e6b5e !important;
                color: #0e6b5e !important;
            }
        .form-check-border .form-check-input {
            border: 2px solid #0e6b5e !important;
        }
   

    </style>
</head>
<body>
     <div class="container-fluid p-0">
        <nav id="mainNav">
            <div class="logo">KITAB<span class="text_arb">كتاب </span></div>
                <ul class="nav-links">
                    <li>
                        <a href="marketPlace.html"><i class="bi bi-shop fs-6"></i>Marketplace</a>
                    </li>
                    <li>
                        <a href="messages.html"><i class="bi bi-chat-left-text"></i>Messages</a>
        </li>
        <li>
          <a href="codeHTML.html"><i class="bi bi-repeat"></i>Exchange</a>
        </li>
        <li>
          <a href="favorisContenantLivres.html"><i class="bi bi-heart"></i>Favoris</a>
        </li>
        <li>
          <a href="reading-rooms.html"><i class="bi bi-book"></i>Reading Room</a>
        </li>
        <hr />
        <li>
          <a href="profile.html"><i class="bi bi-person-circle"></i>Profile</a>
        </li>
        <li>
          <a href=""><i class="bi bi-gear"></i>Settings</a>
        </li>
        <hr />
      </ul>
    </nav>
        <section id="create-account" class="position-relative end-0 min-vh-100 p-4 exchanges mt-5 pt-5" >
            <div class="position-relative mb-4">
                <h class="fw-bold texte-Teal  display-3 position-relative z-0"> create an account </h>
            </div>            
            <form action="treatData.php" method="post" name="user-info">
                <div class="ms-3">
                    <input type="file" id="profile-upload" accept="image/*" style="display: none;"><div>
                    <label for="username" class="form-label fw-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="input your name" required>
                </div>
                <div>
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class='form-control' id="email" name="email" placeholder="email@example.com" required>
                </div>
                <div>
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                </div>
                <div>
                    <label for="Confirm-password" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>                
                </div>
                <div >
                    <label for="country" class="form-label fw-bold">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Country of residence" required> 
                </div>
                <div >
                    <label for="postal-code" class="form-label fw-bold">Postal Code</label>
                    <input type="text" class="form-control" id="postal-code" name="postal_code" placeholder="Postal Code" required> 
                </div>
                <div>
                    <label for="favorite-genres" class="form-label fw-bold">Favorite Genres</label>
                    <input type="text" list="ma-liste" placeholder="tap to see options" class="form-control" id="favorite-genres" name="favorite_genres" required>
                    <datalist id="ma-liste">
                        <option value="Science Fiction">
                        <option value="Literary Fiction">
                        <option value="Fantasy">
                        <option value="Mystery">
                        <option value="Romance">
                        <option value="Thriller">
                        <option value="Non-fiction">
                        <option value="Historical Fiction">
                        <option value="Young Adult">    
                        <option value="Children's Literature">
                        <option value="Contemporary Fiction">
                        <option value="Short Stories">
                        <option value="Novella">
                        <option value="Non-Fiction">
                        <option value="Biography">
                        <option value="Autobiography">
                        <option value="Memoir">
                        <option value="Essay">
                        <option value="Journalism">
                        <option value="Poetry">
                        <option value="Drama">
                        <option value="Play">
                        <option value="Classical Literature">
                        <option value="Modern Literature">
                        <option value="Graphic Novels">
                        <option value="Comics">
                        <option value="Manga">
                        <option value="Mystery">
                        <option value="Crime Fiction">
                        <option value="Detective Fiction">
                        <option value="Noir">
                        <option value="Hard-Boiled">
                        <option value="Police Procedural">
                        <option value="Legal Thriller">
                        <option value="Medical Thriller">
                        <option value="Psychological Thriller">
                        <option value="Techno-Thriller">
                        <option value="Suspense">
                        <option value="Espionage">
                        <option value="Spy Fiction">
                        <option value="Conspiracy Thriller">
                        <option value="Action Thriller">
                        <option value="Adventure Thriller">
                        <option value="other">
                    </datalist>
                </div>
                <div >
                    <label for="language-prefered" class="form-label fw-bold">Language Preferred</label>
                    <input type="text" class="form-control" id="language-prefered" name="language_prefered" placeholder="Language Preferred" required> 
                </div>
                <div>
                    <span class="fw-bold form-label"> Accepted Book Conditions</span>
                    <div class="form-check form-check-border">
                        <input type="radio" class="form-check-input " name="book_condition" id="condition-new" value="new" required>
                        <label class="form-check-label " for="condition-new"> New</label>
                    </div>
                    <div class="form-check form-check-border">
                        <input type="radio" class="form-check-input" name="book_condition" id="condition-used" value="good-condition" required>
                        <label class="form-check-label" for="condition-used"> good condition</label>
                    </div>
                    <div class="form-check form-check-border">
                        <input type="radio" class="form-check-input" name="book_condition" id="condition-acceptable" value="acceptable" required>
                        <label class="form-check-label" for="condition-acceptable"> Acceptable</label>
                    </div>                
                </div>
                 <div>
                    <span class="fw-bold form-label"> exchange preferences</span>
                    <div class="form-check form-check-border">
                        <input type="radio" class="form-check-input" name="type-echange" id="local" value="local" required>
                        <label class="form-check-label" for="local"> Local</label>
                    </div>
                    <div class="form-check form-check-border">
                        <input type="radio" class="form-check-input" name="type-echange" id="postal" value="postal" required>
                        <label class="form-check-label" for="postal"> Postal</label>
                    </div>
                    <div class="form-check form-check-border">
                        <input type="radio" class="form-check-input" name="type-echange" id="condition-acceptable" value="2" required>
                        <label class="form-check-label" for="condition-acceptable"> 2 </label>
                    </div>                
                </div>
                <div >
                    <label for="biography" class="form-label fw-bold">Biography</label>
                    <input type="text" class="form-control mb-3" id="biography" name="biography" placeholder="Biography" required> 
                </div>
                <div>
                    <label for="photo" class="form-label fw-bold">Profile Photo</label>
                    <input type="file" class="form-control mb-3" id="photo" name="photo" accept="image/*" required>
                </div>
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-teal mt-4 me-5 ">submit</button>
                <button type="reset" class="btn btn-outline-teal mt-4 ">Reset</button>
                </div>
            </section>
        </form>