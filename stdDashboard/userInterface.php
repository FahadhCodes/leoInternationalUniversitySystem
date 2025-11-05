<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        table,
        th,
        td {
            border: 1px solid;
            padding: 10px;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <input type="search" id="SEARCH1">
    <select id="SELECT1">
        <option value="1">year 1</option>
        <option value="2">year 2</option>
        <option value="3">year 3</option>
        <option value="4">year 4</option>
    </select>
    <br><br>
    <div class="container">
        <table>
            <thead>
                <th>Subject Code</th>
                <th>Subject Name</th>
            </thead>
            <tbody class="results">
            </tbody>
        </table>
    </div>

    <script>
        const select = document.getElementById("SELECT1");
        const search = document.getElementById("SEARCH1");
        const results = document.querySelector(".results");

        function fetchData() {
            const year = select.value;
            const subjectName = search.value;
            fetch(`getData.php?year=${year}&search=${subjectName}`)
                .then(res => res.json())
                .then(data => {
                    results.innerHTML = '';
                    data.forEach(item => {
                        results.innerHTML += `
                    <tr>
                        <td>${item.subject_id}</td>
                        <td>${item.subject_name}</td>
                    </tr>
                `;
                    })
                })
                .catch(err => console.log("Erro: ", err));
        }
        select.addEventListener("change", fetchData);
        search.addEventListener("keyup", fetchData);
    </script>
</body>

</html>