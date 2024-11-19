<?php
require_once __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temp_id = isset($_POST['temp_id']) ? $_POST['temp_id'] : '1';
    $job_title = isset($_POST['job_title']) ? $_POST['job_title'] : '';
    $job_name = isset($_POST['job_name']) ? $_POST['job_name'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $summary = isset($_POST['summary']) ? $_POST['summary'] : '';
    $employment_title = isset($_POST['employment_title']) ? $_POST['employment_title'] : '';
    $employer = isset($_POST['employer']) ? $_POST['employer'] : '';
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
    $employment_description = isset($_POST['employment_description']) ? $_POST['employment_description'] : '';

    if ($temp_id == 1) {
        $html = "<h2 style='font-weight: bold;'>{$job_title}</h1>";
        $html .= "<p style='color: #6c757d;'>{$job_name}</p>";
        $html .= "<hr>";
        $html .= "<h4>{$first_name} {$last_name}</h4>";
        $html .= "<p><b>Email:</b> {$email}</p>";
        $html .= "<p><b>Phone:</b> {$phone}</p>";
        $html .= "<p><b>Location:</b> {$city}, {$country}</p>";
        $html .= "<hr>";
        $html .= "<h5>Professional Summary</h5>";
        $html .= "<p>{$summary}</p>";
        $html .= "<hr>";
        $html .= "<h5>Employment History</h5>";
        $html .= "<p><strong>{$employment_title}</strong> at {$employer} ({$from_date} - {$to_date})</p>";
        $html .= "<p>{$employment_description}</p>";
    }elseif ($temp_id == 2) {
        // Template 2: Structured Resume Style
        $html = "<div style='font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: auto;'>";
        $html .= "<div style='text-align: center;'>";
        $html .= "<h2 style='font-weight: bold; margin: 0;'>{$job_title}</h2>";
        $html .= "<p style='color: #6c757d; font-size: 18px; margin-top: 5px;'>{$job_name}</p>";
        $html .= "</div>";
        $html .= "<hr style='margin: 20px 0;'>";

        // Personal Information Section
        $html .= "<div style='display: flex; justify-content: space-between; margin-bottom: 20px;'>";
        $html .= "<div>";
        $html .= "<h4 style='font-weight: bold;'>{$first_name} {$last_name}</h4>";
        $html .= "<p style='font-size: 16px; color: #333;'><strong>Email:</strong> {$email}</p>";
        $html .= "<p style='font-size: 16px; color: #333;'><strong>Phone:</strong> {$phone}</p>";
        $html .= "<p style='font-size: 16px; color: #333;'><strong>Location:</strong> {$city}, {$country}</p>";
        $html .= "</div></div>";

        // Professional Summary Section
        $html .= "<div style='margin-bottom: 20px;'>";
        $html .= "<h5 style='font-weight: bold;'>Professional Summary</h5>";
        $html .= "<p style='font-size: 16px; color: #333;'>{$summary}</p>";
        $html .= "</div>";

        $html .= "<hr style='margin: 20px 0;'>";

        // Employment History Section
        $html .= "<div>";
        $html .= "<h5 style='font-weight: bold;'>Employment History</h5>";
        $html .= "<div style='margin-bottom: 15px;'>";
        $html .= "<p style='font-size: 16px; color: #333;'><strong>{$employment_title}</strong> at <em>{$employer}</em> ({$from_date} - {$to_date})</p>";
        $html .= "<p style='font-size: 16px; color: #333;'>{$employment_description}</p>";
        $html .= "</div></div>";
        $html .= "</div>"; // End of container
    }elseif ($temp_id == 3) {

        $html = "
        <div style='font-family: Arial, sans-serif; max-width: 800px; margin: auto; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
        
            <!-- Header: Full Name & Job Title -->
            <div style='text-align: center; margin-bottom: 30px;'>
                <h1 style='font-size: 36px; font-weight: bold; color: #343a40;'>{$first_name} {$last_name}</h1>
                <p style='font-size: 20px; font-weight: bold; color: #007bff;'>{$job_title}</p>
            </div>

            <!-- Contact Information Section -->
            <div style='margin-bottom: 30px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);'>
                <h3 style='font-size: 22px; font-weight: bold; color: #007bff; margin-bottom: 15px;'>Contact Information</h3>
                <p style='font-size: 16px; color: #333;'><strong>Email:</strong> {$email}</p>
                <p style='font-size: 16px; color: #333;'><strong>Phone:</strong> {$phone}</p>
                <p style='font-size: 16px; color: #333;'>{$city}, {$country}</p>
            </div>

            <!-- Professional Summary Section -->
            <div style='margin-bottom: 30px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);'>
                <h3 style='font-size: 22px; font-weight: bold; color: #007bff; margin-bottom: 15px;'>Professional Summary</h3>
                <p style='font-size: 16px; color: #333;'>{$summary}</p>
            </div>

            <!-- Employment History Section -->
            <div style='margin-bottom: 30px; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);'>
                <h3 style='font-size: 22px; font-weight: bold; color: #007bff; margin-bottom: 15px;'>Employment History</h3>
                <div style='margin-bottom: 15px;'>
                    <p style='font-size: 16px; color: #333;'><strong>{$employment_title}</strong> at <em>{$employer}</em> ({$from_date} - {$to_date})</p>
                    <p style='font-size: 16px; color: #333;'>{$employment_description}</p>
                </div>
            </div>

        </div>
        ";

    }

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);

    $mpdf->Output('resume.pdf', 'I');
    exit;
}
?>
