<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <!-- Dashboard Cards -->
    <div class="task-cards desktop">
        <div class="card_DASH assignment">
            <h3 class="headType1">Assignments</h3>
            <div class="countBar rounded-pill">
                <div class="bar"></div>
            </div>
            <div class="numberBar tradi-blue2">90%</div>
            <div class="row">
                <div class="ROW-1 col-6 tradi-yellow2">Compleated</div>
                <div class="ROW-1 col-6 tradi-blue2">23</div>
                <div class="ROW-2 col-6 tradi-yellow2">Balance</div>
                <div class="ROW-2 col-6 tradi-blue2">2</div>
            </div>
        </div>
        <div class="card_DASH quiz">
            <h3 class="headType1">Quizzes</h3>
            <div class="countBar rounded-pill">
                <div class="bar"></div>
            </div>
            <div class="numberBar tradi-blue2">90%</div>
            <div class="row">
                <div class="ROW-1 col-6 tradi-yellow2">Compleated</div>
                <div class="ROW-1 col-6 tradi-blue2">23</div>
                <div class="ROW-2 col-6 tradi-yellow2">Balance</div>
                <div class="ROW-2 col-6 tradi-blue2">2</div>
            </div>
        </div>
        <div class="card_DASH midterm">
            <h3 class="headType1">Online Mid-Term</h3>
            <div class="countBar rounded-pill">
                <div class="bar"></div>
            </div>
            <div class="numberBar tradi-blue2">90%</div>
            <div class="row">
                <div class="ROW-1 col-6 tradi-yellow2">Compleated</div>
                <div class="ROW-1 col-6 tradi-blue2">23</div>
                <div class="ROW-2 col-6 tradi-yellow2">Balance</div>
                <div class="ROW-2 col-6 tradi-blue2">2</div>
            </div>
        </div>
        <div class="card_DASH group-task">
            <h3 class="headType1">Group Tasks</h3>
            <div class="countBar rounded-pill">
                <div class="bar"></div>
            </div>
            <div class="numberBar tradi-blue2">90%</div>
            <div class="row">
                <div class="ROW-1 col-6 tradi-yellow2">Compleated</div>
                <div class="ROW-1 col-6 tradi-blue2">23</div>
                <div class="ROW-2 col-6 tradi-yellow2">Balance</div>
                <div class="ROW-2 col-6 tradi-blue2">2</div>
            </div>
        </div>
    </div>
    <!-- Dashboard Cards Mobile-->
    <div class="task-cards mobile">
        <div class="card_DASH assignment">
            <h3 class="headType1">Assignments</h3>
        </div>
        <div class="card_DASH quiz">
            <h3 class="headType1">Quizzes</h3>
        </div>
        <div class="card_DASH midterm">
            <h3 class="headType1">Online Mid-Term</h3>
        </div>
        <div class="card_DASH group-task">
            <h3 class="headType1">Group Tasks</h3>
        </div>
    </div>

    <!-- GPA Chart + Message Box -->
    <div class="bottom-section">
        <div class="gpa-chart">
            <h2 class="headType1 text-center pb-3">GPA vs Semester</h2>
            <canvas id="gpaChart"></canvas>
        </div>
        <div class="subject-results">
            <h2 class="headType1 text-center pb-3">Subjects</h2>
            <div class="row pb-3 px-lg-3 align-items-center">
                <select name="" id="" class="col-lg-3 col-12 yearAndSem">
                    <option value="0" selected hidden>Select Year</option>
                    <option value="1.1">1.1</option>
                    <option value="1.2">1.2</option>
                    <option value="2.1">2.1</option>
                    <option value="2.2">2.2</option>
                    <option value="3.1">3.1</option>
                    <option value="3.2">3.2</option>
                    <option value="4.1">4.1</option>
                    <option value="4.2">4.2</option>
                </select>
                <label for="search" class="fw-bolder col-lg-2 col-12">Search: </label>
                <input type="search" name="search" id="search" class="inputBarDesign search read col-lg-6 col-10">
                <button
                    type="submit"
                    class="btn btn-dark submit-C read btn readButton col-lg-1 col-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <table class="dashBordTable p-0 m-0">
                <thead>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Subject Result</th>
                </thead>
                <tbody id="tab1">
                </tbody>
            </table>
        </div>
        <div class="message-box">
            <h2 class="headType1 text-center pb-3 pt-md-3">Send Message to Lecturer</h2>
            <label for="Email">Lecturer Email: </label>
            <input id="Email" type="text" class="dashBordMessage inputBarDesign" placeholder="example@email.com">
            <label for="messageText">Message: </label>
            <textarea class="message-box inputBarDesign" id="messageText" placeholder="Write your message..."></textarea>
            <button class="generalButton p-2 dashBordsendButton">Send</button>
        </div>
    </div>
    <script src="../JavaScript/function.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('gpaChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 100, 400);
        gradient.addColorStop(0, ' #b0d8ff');
        gradient.addColorStop(1, '#80b4e721');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1.1', '1.2', '2.1', '2.2', '3.1', '3.2', '4.1', '4.2'],
                datasets: [{
                    label: 'GPA',
                    data: [3.2, 3.5, 3.8, 3.6, 3.2, 3.5, 3.8, 3.6],
                    borderColor: '#122044',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 4
                    }
                }
            }
        });
    </script>
</body>

</html>