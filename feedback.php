<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MedFit</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel = "stylesheet" href = "assets/css/main.css" />
        <link rel = "stylesheet" href = "assets/css/utilities.css" />

        <style>
            .question-container {
                width: 80%;
                margin: 20px auto;
            }

            .slider-container {
                margin-bottom: 20px;
            }

            .value-display {
                font-size: 18px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <form method="POST" action="surveyresults.php">
        <button type="button" class='btn btn-secondary' onclick="window.location.href='profile.php'">Go to Profile</button>
        <main>
                <section class = "sc-services">
                    <div class = "services-shape">
                        <img src = "assets/images/curve-shape-1.png" alt = "">
                    </div>
                    <div class="container">
                        <div class = "services-content">
                            <div class="title-box text-center">
                                <div class = "content-wrapper">
                                    <h3 class = "title-box-name">Feedback Survey</h3>
                                    <div class = "title-separator mx-auto"></div>
                                    <p class = "text title-box-text">Your Feedback Matters!</p>
                                    <p class = "text title-box-text">We strive to enhance your experience on our website, and your input is crucial in achieving that goal. Please take a few minutes to share your thoughts through our feedback survey.</p>
                                </div>
                            </div>

                            <div class = "services-list">
                                <div class = "services-item" style = "width: 100%;">
                                    
                                    <h5 class = "item-title fw-7">Question 1</h5>
                                    <p class = "text">On a scale from 1 (very difficult) to 5 (very easy), how would you rate the overall user interface (i.e ease of navigation) of the system?</p>
                                    <input style="width:100%;" type="range" id="1" name="1" list="tickmarks" value="3" min='1' max='5' oninput="updateValue('1')">
                                    <datalist id="tickmarks">
                                        <option value="1" label="1">
                                        <option value="2" label="2">
                                        <option value="3" label="3">
                                        <option value="4" label="4">
                                        <option value="5" label="5">
                                    </datalist>
                                    <div id="value-display1">5</div>
                                </div>

                                <div class = "services-item" style = "width: 100%;">
                                    
                                    <h5 class = "item-title fw-7">Question 2</h5>
                                    <p class = "text">On a scale from 1 to 10, how would you rate the overall user interface (i.e ease of navigation) of the system?</p>
                                    <input style="width:100%;" type="range" id="2" name="2" list="tickmarks" value="3" min='1' max='5' oninput="updateValue('2')">
                                    <datalist id="tickmarks">
                                        <option value="1" label="1">
                                        <option value="2" label="2">
                                        <option value="3" label="3">
                                        <option value="4" label="4">
                                        <option value="5" label="5">
                                    </datalist>
                                    <div id="value-display1">5</div>
                                
                                </div>

                                <div class = "services-item" style = "width: 100%;">
                                    
                                    <h5 class = "item-title fw-7">Question 3</h5>
                                    <p class = "text">Rate your experience in accessing information from your healthcare provider through the system (1 = Poor, 5 = Excellent).</p>
                                    <input style="width:100%;" type="range" id="3" name="3" list="tickmarks" value="3" min='1' max='5' oninput="updateValue('3')">
                                    <datalist id="tickmarks">
                                        <option value="1" label="1">
                                        <option value="2" label="2">
                                        <option value="3" label="3">
                                        <option value="4" label="4">
                                        <option value="5" label="5">
                                    </datalist>
                                    <div id="value-display1">5</div>

                                </div>

                                <div class = "services-item" style = "width: 100%;">
                                    
                                    <h5 class = "item-title fw-7">Question 4</h5>
                                    <p class = "text">On a scale from 1 to 10, how would you rate the overall user interface (i.e ease of navigation) of the system?</p>
                                    <input style="width:100%;" type="range" id="4" name="4" list="tickmarks" value="3" min='1' max='5' oninput="updateValue('4')">
                                    <datalist id="tickmarks">
                                        <option value="1" label="1">
                                        <option value="2" label="2">
                                        <option value="3" label="3">
                                        <option value="4" label="4">
                                        <option value="5" label="5">
                                    </datalist>
                                    <div id="value-display1">5</div>

                                </div>

                                <div class = "services-item" style = "width: 100%;">
                                   
                                    <h5 class = "item-title fw-7">Question 5</h5>
                                    <p class = "text">On a scale from 1 to 10, how would you rate the overall user interface (i.e ease of navigation) of the system?</p>
                                    <input style="width:100%;" type="range" id="5" name="5" list="tickmarks" value="3" min='1' max='5' oninput="updateValue('5')">
                                    <datalist id="tickmarks">
                                        <option value="1" label="1">
                                        <option value="2" label="2">
                                        <option value="3" label="3">
                                        <option value="4" label="4">
                                        <option value="5" label="5">
                                    </datalist>
                                    <div id="value-display1">5</div>

                                </div>

                            </div>

                            <div class="d-grid gap-3">
                                <button class="btn btn-secondary" onclick="submitValues()">Submit</button>
                            </div>

                        </div>
                    </div>
                </section>

                
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <script>
                    function updateValue(questionNumber) {
                        var slider = document.getElementById(questionNumber);
                        var valueDisplay = document.getElementById("value-display" + questionNumber);
                        valueDisplay.innerHTML = slider.value;
                    }

                    function submitValues() {
                        // Collect values from all questions
                        var values = [];
                        for (var i = 1; i <= 6; i++) {
                            values.push({
                                question: i,
                                value: document.getElementById(i).value
                            });
                        }

                        // Use AJAX to send the values to the server
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "surveyresults.php", true);
                        xhr.setRequestHeader("Content-type", "application/json");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                // Handle the server response if needed
                                console.log(xhr.responseText);
                            }
                        };
                        console.log(JSON.stringify(values));
                        xhr.send(JSON.stringify(values));
                    }
                </script>

                
            <footer class = "footer">
                <div class = "container">
                    <div class = "footer-content">
                        <div class = "footer-list d-grid text-white">
                            <div class = "footer-item">
                                <a href = "#" class = "navbar-brand d-flex align-items-center">
                                    <span class = "brand-shape d-inline-block text-white">M</span>
                                    <span class = "brand-text fw-7">MedFit</span>
                                </a>
                                <p class = "text-white">MedFit provides progressive healthcare, accessible on mobile and online for everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </form>
</body>