<?php
include 'actions.php'; // Make sure this contains the correct DB connection

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume_maker";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_SESSION['email'])) {
    $email = mysqli_real_escape_string($conn, $_SESSION['email']);
    
    $query = "SELECT * FROM data WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);

        $data = json_decode($res['data'], false);

    } else {
        $data = new stdClass();
    }

} else {
    $data = new stdClass();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <style>
        .main_body {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            overflow-y: auto;
        }
        .left-div, .right-div {
            position: fixed;
            top: 0;
            width: 50%;
            height: 100%;
            color: black;
            margin: 20px auto;
            padding: 20px;
            overflow-y: auto;
        }
        .left-div {
            left: 0;
            margin-top: 20px;
            padding-bottom: 125px;
        }
        .right-div {
            right: 0;
            margin-top: 20px;
        }
        iframe {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="app">
        <div v-if="login_email == ''" class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-4" style="width: 400px;">
                <div class="card-body">
                    <h5 class="card-title text-center">Enter Your Email</h5>
                    <div class="mb-3">
                        <input type="email" v-model="email_log" placeholder="Enter your email" class="form-control">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" @click="email_login">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="main_body">
            <div class="left-div">
                <div class="container">
                    <form>
                        <div class="personal_details_div mb-5">
                            <div><p class="fw-bold fs-3 mb-2">Personal Details</p></div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="job_title">Job Title</label>
                                    <input type="text" class="form-control" v-model="data['job_title']" v-on:input="save_form_timer" placeholder="Job Title">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="job_name">Job Place</label>
                                    <input type="text" class="form-control" v-model="data['job_name']" v-on:input="save_form_timer" placeholder="Job Place">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="first_name">First Name</label>
                                    <input type="text" class="form-control" v-model="data['first_name']" v-on:input="save_form_timer" placeholder="First Name">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="last_name">Last Name</label>
                                    <input type="text" class="form-control" v-model="data['last_name']" v-on:input="save_form_timer" placeholder="Last Name">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" v-model="data['email']" v-on:input="save_form_timer" placeholder="Email">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="number" class="form-control" v-model="data['phone']" v-on:input="save_form_timer" placeholder="Phone">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="country">Country</label>
                                    <input type="text" class="form-control" v-model="data['country']" v-on:input="save_form_timer" placeholder="Country">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="city">City</label>
                                    <input type="text" class="form-control" v-model="data['city']" v-on:input="save_form_timer" placeholder="City">
                                </div>
                            </div>
                        </div>

                        <div class="professional_summary_div mb-5">
                            <div><div class="fw-bold fs-3">Professional Summary</div></div>
                            <div class="text-secondary fs-6 mb-2">Write 2-4 short, energetic sentences...</div>
                            <textarea class="form-control" v-model="data['summary']" v-on:input="save_form_timer" style="height: 150px;"></textarea>
                        </div>

                        <div class="employment_history_div mb-5">
                            <div><div class="fw-bold fs-3">Employment History</div></div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="employment_title">Job Title</label>
                                    <input type="text" class="form-control" id="employment_title" v-on:input="save_form_timer" v-model="data['employment_title']" placeholder="Job Title">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="employer">Employer</label>
                                    <input type="text" class="form-control" v-model="data['employer']" v-on:input="save_form_timer" placeholder="Employer">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="from_date">From</label>
                                    <input type="month" class="form-control" v-model="data['from_date']" v-on:input="save_form_timer" placeholder="From">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="to_date">To</label>
                                    <input type="month" class="form-control" v-model="data['to_date']" v-on:input="save_form_timer" placeholder="To">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label class="form-label" for="employment_description">Description</label>
                                    <textarea class="form-control" v-model="data['employment_description']" v-on:input="save_form_timer" style="height: 150px;"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Download button -->
                        
                    </form>
                </div>
            </div>

            <div class="right-div">
                <div class="container" v-if="data['job_title'] != ''">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Template
                          </button>
                          <ul class="dropdown-menu">
                            <li><button class="dropdown-item" @click="temp_id = 1">Template - 1</button></li>
                            <li><button class="dropdown-item" @click="temp_id = 2">Template - 2</button></li>
                            <li><button class="dropdown-item" @click="temp_id = 3">Template - 3</button></li>
                          </ul>
                        </div>
                        <div v-if="save_msg" v-html="save_msg"></div>
                        <div>
        		            <button type="button" class="btn btn-primary" @click="downloadPDF">
                                Download PDF
                            </button>
                        </div>
                    </div>
                    <template v-if="temp_id == 1">
                        <h2 style="font-weight: bold;">{{ data['job_title'] }}</h2>
                        <p style="color: #6c757d;" v-if="data['job_name']">{{ data['job_name'] }}</p>
                        <hr>
                        <h4 v-if="first_name || last_name">{{ data['first_name'] }} {{ data['last_name'] }}</h4>
                        <p v-if="data['email']"><strong>Email:</strong> {{ data['email'] }}</p>
                        <p v-if="data['phone']"><strong>Phone:</strong> {{ data['phone'] }}</p>
                        <p v-if="data['city'] || data['country']"><strong>Location:</strong> {{ data['city'] }}, {{ data['country'] }}</p>
                        <hr v-if="data['summary']">
                        <h5 v-if="data['summary']">Professional Summary</h5>
                        <p v-if="data['summary']">{{ data['summary'] }}</p>
                        <hr v-if="data['employment_title']">
                        <h5 v-if="data['employment_title']">Employment History</h5>
                        <div v-if="data['employment_title']">
                            <p><strong>{{ data['employment_title'] }}</strong> at {{ data['employer'] }} ({{ data['from_date'] }} - {{ data['to_date'] }})</p>
                            <p>{{ data['employment_description'] }}</p>
                        </div>
                    </template>
                    <template v-if="temp_id == 2">
                        <div style="font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: auto;">
                            <!-- Header Section -->
                            <div style="text-align: center;">
                                <h2 style="font-weight: bold; margin: 0;">{{ data['job_title'] }}</h2>
                                <p style="color: #6c757d; font-size: 18px; margin-top: 5px;" v-if="data['job_name']">{{ data['job_name'] }}</p>
                            </div>
                            <hr style="margin: 20px 0;">

                            <!-- Personal Information Section -->
                            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                                <div>
                                    <h4 style="font-weight: bold;">{{ data['first_name'] }} {{ data['last_name'] }}</h4>
                                    <p style="font-size: 16px; color: #333;"><strong>Email:</strong> {{ data['email'] }}</p>
                                    <p style="font-size: 16px; color: #333;"><strong>Phone:</strong> {{ data['phone'] }}</p>
                                    <p style="font-size: 16px; color: #333;" v-if="city || country"><strong>Location:</strong> {{ data['city'] }}, {{ data['country'] }}</p>
                                </div>
                                <div>
                                    <p style="font-size: 16px; color: #333;" v-if="city || country"><strong>Location:</strong> {{ data['city'] }}, {{ data['country'] }}</p>
                                </div>
                            </div>

                            <!-- Professional Summary Section -->
                            <div style="margin-bottom: 20px;">
                                <h5 style="font-weight: bold;">Professional Summary</h5>
                                <p style="font-size: 16px; color: #333;" v-if="data['summary']">{{ data['summary'] }}</p>
                            </div>

                            <hr style="margin: 20px 0;">

                            <!-- Employment History Section -->
                            <div v-if="data['employment_title']" style="margin-bottom: 20px;">
                                <h5 style="font-weight: bold;">Employment History</h5>
                                <div style="margin-bottom: 15px;">
                                    <p style="font-size: 16px; color: #333;"><strong>{{ data['employment_title'] }}</strong> at <em>{{ data['employer'] }}</em> ({{ data['from_date'] }} - {{ data['to_date'] }})</p>
                                    <p style="font-size: 16px; color: #333;">{{ data['employment_description'] }}</p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-if="temp_id == 3">
                        <div style="font-family: 'Arial', sans-serif; max-width: 800px; margin: auto; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                            
                            <!-- Header: Full Name & Job Title -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <h1 style="font-size: 36px; font-weight: bold; color: #343a40;">{{ first_name }} {{ last_name }}</h1>
                                <p style="font-size: 20px; font-weight: bold; color: #007bff;">{{ data['job_title'] }}</p>
                            </div>

                            <!-- Contact Information Section -->
                            <div style="margin-bottom: 30px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                <h3 style="font-size: 22px; font-weight: bold; color: #007bff; margin-bottom: 15px;">Contact Information</h3>
                                <p style="font-size: 16px; color: #333;"><strong>Email:</strong> {{ email }}</p>
                                <p style="font-size: 16px; color: #333;"><strong>Phone:</strong> {{ phone }}</p>
                                <p style="font-size: 16px; color: #333;" v-if="city || country"><strong>Location:</strong> {{ city }}, {{ country }}</p>
                            </div>

                            <!-- Professional Summary Section -->
                            <div style="margin-bottom: 30px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                <h3 style="font-size: 22px; font-weight: bold; color: #007bff; margin-bottom: 15px;">Professional Summary</h3>
                                <p style="font-size: 16px; color: #333;" v-if="data['summary']">{{ data['summary'] }}</p>
                            </div>

                            <!-- Employment History Section -->
                            <div style="margin-bottom: 30px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                <h3 style="font-size: 22px; font-weight: bold; color: #007bff; margin-bottom: 15px;">Employment History</h3>
                                <div style="margin-bottom: 15px;">
                                    <p style="font-size: 16px; color: #333;"><strong>{{ data['employment_title'] }}</strong> at <em>{{ data['employer'] }}</em> ({{ data['from_date'] }} - {{ data['to_date'] }})</p>
                                    <p style="font-size: 16px; color: #333;">{{ data['employment_description'] }}</p>
                                </div>
                            </div>

                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        var app = Vue.createApp({
            data() {
                return {
                    data: <?php echo json_encode($data); ?>, 
                    pdfPreviewUrl: '',
                    temp_id: 1,
                    login_email: '<?php echo $_SESSION['email'] ?? ""; ?>',
                    email_enter:'',
                    typingTimeout: null,
                    save_msg:'',
                };
            },
            mounted(){
                console.log(this.data)
            },
            methods: {
                save_form_timer() {
                    console.log(this.data)
                    this.save_msg = `saving <img width="19" height="19" src="https://img.icons8.com/windows/32/cloud-refresh--v2.png" alt="cloud-refresh--v2"/>`;
                    clearTimeout(this.typingTimeout);

                    this.typingTimeout = setTimeout(() => {
                        this.save_details();
                    }, 2000);
                },
                save_details() {
                    // Convert Vue Proxy object to a plain object by using JSON serialization
                    const plainData = JSON.parse(JSON.stringify(this.data));  // This removes the Proxy and gives you a plain object

                    console.log("Sending plain data to server:", plainData);  // Log the plain data to verify

                    fetch('actions.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'action=save_data&email=' + encodeURIComponent(this.login_email) + 
                              '&data=' + encodeURIComponent(JSON.stringify(plainData))  // Send plain object
                    })
                    .then(response => response.json())  // assuming response will be JSON
                    .then(responseData => {
                        if (responseData.success) {
                            console.log("Data saved successfully");
                            this.save_msg = `Saved <img width="19" height="19" src="https://img.icons8.com/material-outlined/24/upload-to-cloud.png" alt="upload-to-cloud"/>`;
                        } else {
                            console.error("Error saving data:", responseData.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error saving data:', error);
                    });
                },
                email_login() {
                    if (this.email_log) {
                        this.login_email = this.email_log;

                        fetch('actions.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'action=email_login&email=' + encodeURIComponent(this.email_log)
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log('Email stored successfully:', data);
                        })
                        .catch(error => {
                            console.error('Error storing email:', error);
                        });
                    }
                },
                downloadPDF() {
                    // alert("present this feature is not working! will update soon");
                    // return;
                    const formData = new FormData();

                    // Add fields conditionally only if they have values
                    if (this.data['temp_id']) formData.append("temp_id", this.data['temp_id']);
                    if (this.data['job_title']) formData.append("job_title", this.data['job_title']);
                    if (this.data['job_name']) formData.append("job_name", this.data['job_name']);
                    if (this.data['first_name']) formData.append("first_name", this.data['first_name']);
                    if (this.data['last_name']) formData.append("last_name", this.data['last_name']);
                    if (this.data['email']) formData.append("email", this.data['email']);
                    if (this.data['phone']) formData.append("phone", this.data['phone']);
                    if (this.data['city']) formData.append("city", this.data['city']);
                    if (this.data['country']) formData.append("country", this.data['country']);
                    if (this.data['summary']) formData.append("summary", this.data['summary']);
                    if (this.data['employment_title']) formData.append("employment_title", this.data['employment_title']);
                    if (this.data['employer']) formData.append("employer", this.data['employer']);
                    if (this.data['from_date']) formData.append("from_date", this.data['from_date']);
                    if (this.data['to_date']) formData.append("to_date", this.data['to_date']);
                    if (this.data['employment_description']) formData.append("employment_description", this.data['employment_description']);

                    // Send the FormData to the server for PDF generation
                    fetch('generate_pdf.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement("a");
                        a.href = url;
                        a.download = 'resume.pdf';
                        a.click();
                    })
                    .catch(error => {
                        console.error("Error generating PDF:", error);
                    });
                },
            },
        }).mount("#app");
    </script>
</body>
</html>
