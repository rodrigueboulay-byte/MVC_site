<?php
    /**
     * Affichage de Liste des articles. 
     */
?>

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
            <tr>
                <td><?= htmlspecialchars($article->getIdUser()) ?></td>
                <td><?= htmlspecialchars($article->getTitle()) ?></td>
                <td><?= htmlspecialchars($article->getContent()) ?></td>
                <td><?= htmlspecialchars($article->getDateCreation()-> format ('d/m/Y H:i')) ?></td>
                <td><?= htmlspecialchars($article->getDateUpdate()-> format ('d/m/Y H:i')) ?></td>
                <td><?= htmlspecialchars($article->getViews()) ?></td>
            </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>
</div>
