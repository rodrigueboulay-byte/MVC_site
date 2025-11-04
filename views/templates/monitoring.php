<?php
    /**
     * Affichage de Liste des articles. 
     */
?>
<?php $userManager = new UserManager(); ?>

<h1>📊 Tableau de bord — Articles</h1>

<div class="table-container">
    <table class="monitoring-table">
        <thead>
            <tr>
                <th>Auteur</th>
                <th>Titre</th>
                <th>Contenue</th>
                <th>Date de creation</th>
                <th>Date de mise a jour</th>
                <th>Nombre de vues</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <?php $user = $userManager->getUserById($article->getIdUser()); ?>
            <tr>
                <td><?= $user ? htmlspecialchars($user->getLogin()) : 'Inconnu' ?></td>
                <td><?= htmlspecialchars($article->getTitle()) ?></td>
                <td><?= htmlspecialchars(mb_substr($article->getContent(), 0, 500)) ?>...</td>
                <td><?= htmlspecialchars($article->getDateCreation()-> format ('d/m/Y H:i')) ?></td>
                <td><?= htmlspecialchars($article->getDateUpdate()-> format ('d/m/Y H:i')) ?></td>
                <td><?= htmlspecialchars($article->getViews()) ?></td>
            </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>
</div>
