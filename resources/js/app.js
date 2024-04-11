function deletarItem(id, token) {
    if (confirm('Tem certeza de que deseja excluir este item?')) {
        const data = { id: id };
        
        fetch(`/series/deletar`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                console.error('Erro ao excluir o item');
            }
        })
        .catch(error => {
            console.error('Erro ao excluir o item:', error);
        });
    }
}