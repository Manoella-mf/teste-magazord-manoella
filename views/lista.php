<div class="container">
    <h1>Pessoas Cadastradas</h1>

    <form action="index.php" method="GET" class="search-form" style="margin-bottom: 20px; display: flex; gap: 10px;">
        <input type="hidden" name="acao" value="listar">
        <input type="text" name="busca" placeholder="Pesquisar por nome..." 
               value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>" 
               style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <button type="submit" class="btn-edit" style="padding: 8px 20px; cursor: pointer;">Buscar</button>
        
        <?php if (!empty($_GET['busca'])): ?>
            <a href="index.php?acao=listar" class="back-link" style="margin-top: 10px;">Limpar</a>
        <?php endif; ?>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pessoas as $p): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><?= $p->getNome() ?></td>
                <td><?= $p->getCpf() ?></td>
                <td>
                    <a href="index.php?acao=editar&id=<?= $p->getId() ?>" class="btn-edit">Editar</a>
                    <a href="index.php?acao=excluir&id=<?= $p->getId() ?>" 
                       class="btn-delete"
                       onclick="return confirm('Deseja realmente excluir esta pessoa?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($pessoas)): ?>
            <tr>
                <td colspan="4" style="text-align:center;">Nenhum registro encontrado.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="index.php?acao=novo" class="back-link">← Voltar ao cadastro</a>
</div>