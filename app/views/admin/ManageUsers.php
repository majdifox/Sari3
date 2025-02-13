<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Gestion des Utilisateurs - Sari3</title>
</head>
<body class="flex bg-gray-100 min-h-screen">
    <main class="p-6 sm:p-10 space-y-6">
        <h1 class="text-4xl font-semibold mb-2">Gestion des Utilisateurs</h1>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Statut</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <!-- User rows will be populated here -->
            </tbody>
        </table>
        <script>
            // Fetch Users
            fetch('/admin/users')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('tbody');
                    data.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class='py-2 px-4 border-b'>${user.name}</td>
                            <td class='py-2 px-4 border-b'>${user.email}</td>
                            <td class='py-2 px-4 border-b'>${user.status}</td>
                            <td class='py-2 px-4 border-b'>
                                <button onclick='validateUser(${user.id})'>Valider</button>
                                <button onclick='suspendUser(${user.id})'>Suspendre</button>
                                <button onclick='deleteUser(${user.id})'>Supprimer</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                });

            function validateUser(id) {
                fetch(`/admin/validate/${id}`, { method: 'POST' })
                    .then(response => response.json())
                    .then(data => { alert(data.status); });
            }

            function suspendUser(id) {
                fetch(`/admin/suspend/${id}`, { method: 'POST' })
                    .then(response => response.json())
                    .then(data => { alert(data.status); });
            }

            function deleteUser(id) {
                fetch(`/admin/delete/${id}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(data => { alert(data.status); });
            }
        </script>
    </main>
</body>
</html>
