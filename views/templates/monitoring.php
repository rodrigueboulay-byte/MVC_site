<?php $userManager = new UserManager(); ?>

<h1>Tableau de bord — Articles</h1>

<div class="table-container">
    <table class="monitoring-table" id="articles-table">
        <thead>
            <tr>
                <th data-type="string">Titre</th>
                <th data-type="date">Date de Publication</th>
                <th data-type="number">Nombre de vues</th>
                <th data-type="number">Nombre de commentaires</th>
                <th data-nosort="true">Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= htmlspecialchars($article->getTitle()) ?></td>
                <td><?= htmlspecialchars($article->getDateCreation()->format('d/m/Y H:i')) ?></td>
                <td><?= htmlspecialchars($article->getViews()) ?></td>
                <?php 
                    $commentManager = new CommentManager;
                    $comments = $commentManager->getAllCommentsByArticleId($article->getId());
                    $nbComments = count($comments);
                ?>
                <td><?= htmlspecialchars($nbComments) ?></td>
                <td><a href="index.php?action=editComments&id=<?= $article->getId() ?>">Modifier les commentaires</a></td>
            </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>
</div>

<!-- Script de tri -->
<script>
document.querySelectorAll("#articles-table th").forEach(th => {
  // Si la colonne a l'attribut data-nosort, on la rend non cliquable
  if (th.hasAttribute("data-nosort")) return;

  th.addEventListener("click", () => {
    const table = th.closest("table");
    const tbody = table.querySelector("tbody");
    const type = th.dataset.type;
    const index = Array.from(th.parentNode.children).indexOf(th);
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const asc = !th.classList.contains("asc");

    // Tri des lignes
    rows.sort((a, b) => {
      let A = a.children[index].innerText.trim();
      let B = b.children[index].innerText.trim();

      if (type === "number") {
        A = parseFloat(A) || 0; B = parseFloat(B) || 0;
      } else if (type === "date") {
        // Conversion de "dd/mm/yyyy hh:mm" vers un timestamp
        const partsA = A.split(/[/\s:]/);
        const partsB = B.split(/[/\s:]/);
        A = new Date(partsA[2], partsA[1]-1, partsA[0], partsA[3]||0, partsA[4]||0).getTime();
        B = new Date(partsB[2], partsB[1]-1, partsB[0], partsB[3]||0, partsB[4]||0).getTime();
      } else {
        A = A.toLowerCase(); B = B.toLowerCase();
      }
      return asc ? (A > B ? 1 : -1) : (A < B ? 1 : -1);
    });

    // Réinjection dans le tableau
    tbody.innerHTML = "";
    rows.forEach(r => tbody.appendChild(r));

    // Mise à jour des icônes ↑↓
    table.querySelectorAll("th").forEach(th2 => th2.classList.remove("asc","desc"));
    th.classList.add(asc ? "asc" : "desc");
  });
});
</script>
