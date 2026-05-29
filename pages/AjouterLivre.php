<?php
//affichage des erreurs PHP 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../config/autoloader.php');


$bookRepo = new BookRepository();

$books = $bookRepo->findAll(); 
?>



<?php if (empty($books)): ?>
    <p style="text-align:center; width:100%; grid-column: 1/-1;">Aucun livre dynamique trouvé.</p>
<?php else: ?>
    <?php 
    
    $css_mapping = [
        'neuf'   => 'like-new',
        'bon'    => 'good',
        'moyen'  => 'Fair',
        'abimé'  => 'Acceptable'
    ];

    
    $text_mapping = [
        'neuf'   => 'Like-New',
        'bon'    => 'Good',
        'moyen'  => 'Fair',
        'abimé'  => 'Acceptable'
    ];
    ?>

    <?php foreach ($books as $book): ?>
        <?php 
           
            $classe_css = $css_mapping[$book->condition] ?? 'good'; 
            $texte_en   = $text_mapping[$book->condition] ?? 'Good';
        ?>
        
        <div class="book-card">
            <div class="image-container">
                <?php  if (strpos($book->image, 'http') === 0) {
                 $src_final = htmlspecialchars($book->image);
                } else {
                     $src_final = "../uploads/" . htmlspecialchars($book->image);
                        }
                            ?>
                <img src="<?php echo $src_final; ?>" alt="Livre" />
                
                <div class="conditionbook <?php echo $classe_css; ?>">
                    <?php echo $texte_en; ?>
                </div>

                <?php if ($book->for_exchange): ?>
                    <div class="forexchange">for exchange</div>
                <?php endif; ?>

                <label class="heart">
            <input type="checkbox" class="fav-checkbox" data-book-id="<?php echo $book->id; ?>" />
            <span class="icon"><i class="bi bi-heart-fill"></i></span>
        </label>
            </div>

            <div class="card-body">
                <h4 class="nombook"><?php echo htmlspecialchars($book->titre); ?></h4>
                <p>by <?php echo htmlspecialchars($book->auteur); ?></p>
                <h6 class="booktype"><?php echo htmlspecialchars($book->genre); ?></h6>
                <span class="price" style="margin-left: 50px; color: green">
                    <?php echo number_format($book->prix, 1); ?>dt
                </span>
                <br />
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($book->auteur); ?>&background=random" alt="" class="ownerpic" />
                <span class="person">Vendeur #<?php echo $book->user_id; ?></span><br />
                
                <a href="../includes/functions/details.php?id=<?php echo $book->id; ?>" class="details">
                    <i class="bi bi-book"></i> Details
                </a>
                <a href="chat.php?with=<?php echo $book->user_id; ?>" class="chat">
                    <i class="bi bi-chat-left"></i> Chat
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<script>
document.addEventListener("DOMContentLoaded", function () {

    
    fetch('/projet_web/KITAB/config/models/ajax/get_favorites.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            data.favorites.forEach(bookId => {
                const checkbox = document.querySelector('.fav-checkbox[data-book-id="' + bookId + '"]');
                if (checkbox) checkbox.checked = true;
            });
        }
    });

 
    const favCheckboxes = document.querySelectorAll('.fav-checkbox');
    favCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const bookId = this.getAttribute('data-book-id');
            const currentCheckbox = this;
            const isChecked = this.checked;

            fetch('/projet_web/KITAB/config/models/ajax/toggle_favorite.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'book_id=' + encodeURIComponent(bookId)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.action === 'added') {
                        currentCheckbox.checked = true;
                    } else if (data.action === 'removed') {
                        currentCheckbox.checked = false;
                    }
                } else {
                    currentCheckbox.checked = !isChecked;
                }
            })
            .catch(error => {
                console.error('Erreur AJAX:', error);
                currentCheckbox.checked = !isChecked;
            });
        });
    });
});
</script>