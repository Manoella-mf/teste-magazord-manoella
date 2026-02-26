<div class="container">
    <h1><?= isset($pessoa) ? 'Editar Pessoa' : 'Cadastrar Pessoa' ?></h1>

    <form action="index.php?acao=salvar" method="POST">
        <input type="hidden" name="id" value="<?= isset($pessoa) ? $pessoa->getId() : '' ?>">

        <label>Dados Principais</label>
        <input type="text" name="nome" value="<?= isset($pessoa) ? $pessoa->getNome() : '' ?>" placeholder="Nome Completo" required>
        <input type="text" name="cpf" value="<?= isset($pessoa) ? $pessoa->getCpf() : '' ?>" placeholder="000.000.000-00" required>

        <hr>
        <label>Contatos (Telefone ou E-mail)</label>
        <div id="lista-contatos">
            <?php if (isset($pessoa)): ?>
                <?php foreach ($pessoa->getContatos() as $contato): ?>
                    <div class="contato-item" style="display: flex; gap: 10px; margin-bottom: 10px;">
                        <select name="contato_tipo[]">
                            <option value="Telefone" <?= $contato->getTipo() == 'Telefone' ? 'selected' : '' ?>>Telefone</option>
                            <option value="Email" <?= $contato->getTipo() == 'Email' ? 'selected' : '' ?>>E-mail</option>
                        </select>
                        <input type="text" name="contato_descricao[]" value="<?= $contato->getDescricao() ?>" placeholder="Descrição..." required>
                        <button type="button" onclick="this.parentElement.remove()" class="btn-delete" style="width: auto;">X</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <button type="button" id="add-contato" style="background: var(--secondary-color); margin-bottom: 20px;">+ Adicionar Contato</button>

        <button type="submit">
            <?= isset($pessoa) ? 'Salvar Alterações' : 'Cadastrar Agora' ?>
        </button>
    </form>
    
    <br>
    <a href="index.php?acao=listar" class="back-link">Voltar para a listagem</a>
</div>

<script>
    
    document.getElementById('add-contato').addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'contato-item';
        div.style = "display: flex; gap: 10px; margin-bottom: 10px;";
        div.innerHTML = `
            <select name="contato_tipo[]">
                <option value="Telefone">Telefone</option>
                <option value="Email">E-mail</option>
            </select>
            <input type="text" name="contato_descricao[]" placeholder="Descrição..." required>
            <button type="button" onclick="this.parentElement.remove()" class="btn-delete" style="width: auto;">X</button>
        `;
        document.getElementById('lista-contatos').appendChild(div);
    });
</script>