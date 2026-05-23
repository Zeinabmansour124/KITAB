<?php if (empty($books)): ?>
    <p style="text-align:center; width:100%; grid-column: 1/-1;">Aucun livre dynamique trouvé.</p>
<?php else: ?>
    <?php 
    // 1. Pour le CSS (Design)
    $css_mapping = [
        'neuf'   => 'like-new',
        'bon'    => 'good',
        'moyen'  => 'Fair',
        'abimé'  => 'Acceptable'
    ];

    // 2. Pour le Texte (Affichage en anglais)
    $text_mapping = [
        'neuf'   => 'Like-New',
        'bon'    => 'Good',
        'moyen'  => 'Fair',
        'abimé'  => 'Acceptable'
    ];
    ?>

    <?php foreach ($books as $book): ?>
        <?php 
            // On récupère la classe et le texte correspondant à la valeur SQL
            $classe_css = $css_mapping[$book->condition] ?? 'good'; 
            $texte_en   = $text_mapping[$book->condition] ?? 'Good';
        ?>
        
        <div class="book-card">
            <div class="image-container">
                <img src="uploads/<?php echo htmlspecialchars($book->image); ?>" alt="Livre" />
                
                <div class="conditionbook <?php echo $classe_css; ?>">
                    <?php echo $texte_en; ?>
                </div>

                <?php if ($book->for_exchange): ?>
                    <div class="forexchange">for exchange</div>
                <?php endif; ?>

                <label class="heart">
            <input type="checkbox" />
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
                
                <a href="details.php?id=<?php echo $book->id; ?>" class="details">
                    <i class="bi bi-book"></i> Details
                </a>
                <a href="chat.php?with=<?php echo $book->user_id; ?>" class="chat">
                    <i class="bi bi-chat-left"></i> Chat
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>