<h1>Commentaires — <?= htmlspecialchars($article->getTitle()) ?></h1>

<table class="monitoring-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Pseudo</th>
      <th>Contenu</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($comments as $c): ?>
    <tr>
      <td><?= htmlspecialchars($c->getIdArticle()) ?></td>
      <td><?= htmlspecialchars($c->getPseudo()) ?></td>
      <td><?= htmlspecialchars($c->getContent()) ?></td>
      <td><?= htmlspecialchars($c->getDateCreation()->format('d/m/Y H:i')) ?></td>
      <td>
        <a href="index.php?action=deleteComment&id=<?= $c->getId() ?>&article=<?= $article->getId() ?>"
           onclick="return confirm('Supprimer ce commentaire ?')">Supprimer</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
