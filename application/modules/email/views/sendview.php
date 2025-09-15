<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="sendV_container">
            <section class="sendV_panel">
                <header class="sendV_panel_header">
                    <h2 class="sendV_title">Send Email</h2>
                    <!-- Disabled Header Buttons -->
                    <div class="sendV_header_buttons">
                        <button class="sendV_btn sendV_btn_primary" type="button" onclick="sendV_showSentMessages()">
                            <i class="sendV_icon">📧</i> Sent Messages
                        </button>
                        <!-- <button class="sendV_btn sendV_btn_disabled" disabled type="button">
                            <i class="sendV_icon">📝</i> Templates
                        </button> -->
                        <!-- <button class="sendV_btn sendV_btn_disabled" disabled type="button">
                            <i class="sendV_icon">➕</i> Add Template
                        </button> -->
                    </div>
                </header>

                <div class="sendV_panel_body">
                    <!-- Sent Messages Section -->
                    <div id="sendV_sent_messages" style="display: none; margin-bottom: 32px;">
                        <h3 class="sendV_section_title">
                            <i class="sendV_icon">📧</i> Sent Messages
                        </h3>
                        <div id="sendV_sent_messages_content"></div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="sendV_progress_container" id="sendV_progress_container" style="display: none;">
                        <div class="sendV_progress_bar">
                            <div class="sendV_progress_fill" id="sendV_progress_fill"></div>
                        </div>
                        <div class="sendV_progress_text" id="sendV_progress_text">Sending email...</div>
                    </div>

                    <!-- Alert Messages -->
                    <div class="sendV_alert sendV_alert_success" id="sendV_success_alert" style="display: none;">
                        <i class="sendV_icon">✅</i>
                        <span id="sendV_success_message"></span>
                        <button class="sendV_alert_close" onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                    
                    <div class="sendV_alert sendV_alert_error" id="sendV_error_alert" style="display: none;">
                        <i class="sendV_icon">❌</i>
                        <span id="sendV_error_message"></span>
                        <button class="sendV_alert_close" onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>

                    <form id="sendV_email_form" class="sendV_form">
                        <!-- Email Recipients Section -->
                        <div class="sendV_form_section">
                            <h3 class="sendV_section_title">
                                <i class="sendV_icon">👥</i> Recipients
                            </h3>
                            
                            <div class="sendV_recipient_group">
                                <label class="sendV_label">
                                    <input type="email" class="sendV_input sendV_email_input" name="recipients[]" placeholder="Enter email address" required>
                                    <button type="button" class="sendV_btn_remove" onclick="sendV_removeRecipient(this)" style="display: none;">×</button>
                                </label>
                            </div>
                            
                            <button type="button" class="sendV_btn sendV_btn_secondary" id="sendV_add_recipient" onclick="sendV_addRecipient()">
                                <i class="sendV_icon">➕</i> Add Another Recipient
                            </button>
                            <div class="sendV_recipient_count">Recipients: <span id="sendV_count">1</span>/10</div>
                        </div>

                        <!-- Quick Selection Options - Patients Only -->
                        <div class="sendV_form_section">
                            <h3 class="sendV_section_title">
                                <i class="sendV_icon">⚡</i> Quick Select Patients
                            </h3>
                            
                            <div class="sendV_quick_options">
                                <!--<label class="sendV_radio_card">-->
                                <!--    <input type="radio" name="quick_select" value="allpatient">-->
                                <!--    <div class="sendV_card_content">-->
                                <!--        <i class="sendV_icon">🏥</i>-->
                                <!--        <span>All Patients</span>-->
                                <!--    </div>-->
                                <!--</label>-->
                                
                                <label class="sendV_radio_card">
                                    <input type="radio" name="quick_select" value="single_patient">
                                    <div class="sendV_card_content">
                                        <i class="sendV_icon">👤</i>
                                        <span>Select Patient</span>
                                    </div>
                                </label>
                            </div>

                            <!-- Single Patient Selection -->
                            <div class="sendV_conditional_field" id="sendV_single_patient" style="display: none;">
                                <label class="sendV_label">Select Patient</label>
                                <input type="text" class="sendV_input" id="sendV_patient_search" placeholder="Search by name or email...">
                                <ul id="sendV_patient_results" class="sendV_results_list" style="display: none; list-style: none; padding: 0; margin: 8px 0 0; background: white; border: 1px solid #e5e7eb; border-radius: 8px; max-height: 200px; overflow-y: auto;"></ul>
                                <input type="hidden" id="sendV_patient_id" name="patient" value="">
                            </div>
                        </div>

                        <!-- Email Content Section -->
                        <div class="sendV_form_section">
                            <h3 class="sendV_section_title">
                                <i class="sendV_icon">✉️</i> Email Content
                            </h3>
                            
                            <div class="sendV_form_group">
                                <label class="sendV_label">Subject *</label>
                                <input type="text" class="sendV_input" name="subject" id="sendV_subject" placeholder="Enter email subject" required>
                            </div>

                            <div class="sendV_form_group">
                                <label class="sendV_label">Message *</label>
                                <div class="sendV_shortcode_buttons">
                                    <button type="button" class="sendV_shortcode_btn" onclick="sendV_addShortcode('[name]')">
                                        [name]
                                    </button>
                                    <button type="button" class="sendV_shortcode_btn" onclick="sendV_addShortcode('[email]')">
                                        [email]
                                    </button>
                                    <button type="button" class="sendV_shortcode_btn" onclick="sendV_addShortcode('[date]')">
                                        [date]
                                    </button>
                                    <button type="button" class="sendV_shortcode_btn" onclick="sendV_addShortcode('[time]')">
                                        [time]
                                    </button>
                                </div>
                                <div class="sendV_editor_container">
                                    <div class="sendV_editor_toolbar">
                                        <button type="button" class="sendV_toolbar_btn" onclick="sendV_formatText('bold')" title="Bold">
                                            <strong>B</strong>
                                        </button>
                                        <button type="button" class="sendV_toolbar_btn" onclick="sendV_formatText('italic')" title="Italic">
                                            <em>I</em>
                                        </button>
                                        <button type="button" class="sendV_toolbar_btn" onclick="sendV_formatText('underline')" title="Underline">
                                            <u>U</u>
                                        </button>
                                        <div class="sendV_toolbar_separator"></div>
                                        <button type="button" class="sendV_toolbar_btn" onclick="sendV_formatText('insertUnorderedList')" title="Bullet List">
                                            • List
                                        </button>
                                        <button type="button" class="sendV_toolbar_btn" onclick="sendV_formatText('createLink')" title="Insert Link">
                                            🔗 Link
                                        </button>
                                    </div>
                                    <div class="sendV_editor" id="sendV_message_editor" contenteditable="true" placeholder="Enter your message here..."></div>
                                </div>
                                <textarea name="message" id="sendV_message_hidden" style="display: none;" required></textarea>
                            </div>
                        </div>

                        <!-- Attachments Section -->
                        <div class="sendV_form_section">
                            <h3 class="sendV_section_title">
                                <i class="sendV_icon">📎</i> Attachments
                            </h3>
                            
                            <div class="sendV_file_upload">
                                <input type="file" id="sendV_file_input" name="attachments[]" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt,.zip" style="display: none;">
                                <div class="sendV_file_drop_zone" onclick="document.getElementById('sendV_file_input').click()">
                                    <i class="sendV_icon sendV_upload_icon">📁</i>
                                    <p>Click to select files or drag and drop</p>
                                    <small>Supported: Images, PDF, DOC, TXT, ZIP (Max 10MB each)</small>
                                </div>
                                <div class="sendV_file_list" id="sendV_file_list"></div>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="sendV_form_section">
                            <div class="sendV_submit_container">
                                <button type="submit" class="sendV_btn sendV_btn_send" id="sendV_submit_btn">
                                    <i class="sendV_icon">🚀</i>
                                    <span>Send Email</span>
                                </button>
                                <div class="sendV_sending_status" id="sendV_sending_status" style="display: none;">
                                    <div class="sendV_spinner"></div>
                                    <span>Sending...</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>

<style>
/* Modern Email Sender Styles */
.sendV_container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
}

.sendV_panel {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.sendV_panel_header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 24px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.sendV_title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: -0.025em;
}

.sendV_header_buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.sendV_btn {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    min-height: 44px;
    box-sizing: border-box;
}

.sendV_btn_primary {
    background: #10b981;
    color: white;
}

.sendV_btn_primary:hover {
    background: #059669;
    transform: translateY(-1px);
}

.sendV_btn_secondary {
    background: #6b7280;
    color: white;
}

.sendV_btn_secondary:hover {
    background: #4b5563;
}

.sendV_btn_disabled {
    background: #9ca3af;
    color: #d1d5db;
    cursor: not-allowed;
    opacity: 0.5;
}

.sendV_btn_disabled:hover {
    transform: none;
    background: #9ca3af;
}

.sendV_btn_send {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 16px 32px;
    font-size: 16px;
    min-width: 200px;
    justify-content: center;
}

.sendV_btn_send:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.sendV_btn_remove {
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    cursor: pointer;
    font-size: 16px;
    line-height: 1;
    margin-left: 8px;
}

.sendV_panel_body {
    padding: 32px;
}

.sendV_form_section {
    margin-bottom: 40px;
    padding-bottom: 32px;
    border-bottom: 1px solid #e5e7eb;
}

.sendV_form_section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.sendV_section_title {
    margin: 0 0 24px 0;
    font-size: 20px;
    font-weight: 600;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 12px;
}

.sendV_icon {
    font-size: 20px;
}

.sendV_form_group {
    margin-bottom: 24px;
}

.sendV_label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #374151;
    font-size: 14px;
}

.sendV_input, .sendV_select, .sendV_textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.2s ease;
    box-sizing: border-box;
    font-family: inherit;
}

.sendV_input:focus, .sendV_select:focus, .sendV_textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.sendV_recipient_group {
    margin-bottom: 12px;
}

.sendV_recipient_group .sendV_label {
    display: flex;
    align-items: center;
    margin-bottom: 0;
}

.sendV_email_input {
    flex: 1;
    margin-right: 8px;
}

.sendV_recipient_count {
    font-size: 14px;
    color: #6b7280;
    text-align: right;
    margin-top: 8px;
}

.sendV_quick_options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.sendV_radio_card {
    position: relative;
    cursor: pointer;
    display: block;
}

.sendV_radio_card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    cursor: pointer;
}

.sendV_card_content {
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.sendV_radio_card input[type="radio"]:checked + .sendV_card_content {
    background: #eff6ff;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.sendV_card_content:hover {
    border-color: #9ca3af;
}

.sendV_conditional_field {
    margin-top: 16px;
    padding: 16px;
    background: #f9fafb;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

.sendV_shortcode_buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
}

.sendV_shortcode_btn {
    background: #e5e7eb;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.sendV_shortcode_btn:hover {
    background: #d1d5db;
}

.sendV_editor_container {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
}

.sendV_editor_toolbar {
    background: #f9fafb;
    padding: 8px 12px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    gap: 4px;
    align-items: center;
}

.sendV_toolbar_btn {
    background: none;
    border: none;
    padding: 6px 8px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.2s ease;
}

.sendV_toolbar_btn:hover {
    background: #e5e7eb;
}

.sendV_toolbar_separator {
    width: 1px;
    height: 20px;
    background: #d1d5db;
    margin: 0 8px;
}

.sendV_editor {
    min-height: 200px;
    padding: 16px;
    outline: none;
    line-height: 1.6;
}

.sendV_editor:empty:before {
    content: attr(placeholder);
    color: #9ca3af;
}

.sendV_file_upload {
    margin-top: 16px;
}

.sendV_file_drop_zone {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #fafafa;
}

.sendV_file_drop_zone:hover {
    border-color: #667eea;
    background: #f0f4ff;
}

.sendV_upload_icon {
    font-size: 48px;
    margin-bottom: 16px;
    display: block;
}

.sendV_file_list {
    margin-top: 16px;
}

.sendV_file_item {
    background: #f3f4f6;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sendV_file_info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sendV_file_remove {
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 4px 8px;
    cursor: pointer;
    font-size: 12px;
}

.sendV_submit_container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    padding-top: 24px;
}

.sendV_sending_status {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #667eea;
    font-weight: 500;
}

.sendV_spinner {
    width: 20px;
    height: 20px;
    border: 2px solid #e5e7eb;
    border-top: 2px solid #667eea;
    border-radius: 50%;
    animation: sendV_spin 1s linear infinite;
}

@keyframes sendV_spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.sendV_progress_container {
    margin-bottom: 24px;
    background: #f9fafb;
    border-radius: 8px;
    padding: 16px;
}

.sendV_progress_bar {
    width: 100%;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 8px;
}

.sendV_progress_fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 4px;
    transition: width 0.3s ease;
    width: 0%;
}

.sendV_progress_text {
    text-align: center;
    font-size: 14px;
    color: #6b7280;
    font-weight: 500;
}

.sendV_alert {
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
}

.sendV_alert_success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.sendV_alert_error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.sendV_alert_close {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: inherit;
    opacity: 0.7;
}

.sendV_alert_close:hover {
    opacity: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sendV_container {
        padding: 12px;
    }
    
    .sendV_panel_header {
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
    }
    
    .sendV_header_buttons {
        justify-content: center;
    }
    
    .sendV_quick_options {
        grid-template-columns: 1fr;
    }
    
    .sendV_panel_body {
        padding: 20px;
    }
    
    .sendV_shortcode_buttons {
        flex-direction: column;
    }
    
    .sendV_submit_container {
        flex-direction: column;
    }
    
    .sendV_btn_send {
        width: 100%;
    }
}

/* Animation Classes */
.sendV_fade_in {
    animation: sendV_fadeIn 0.3s ease-in;
}

@keyframes sendV_fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.sendV_slide_in {
    animation: sendV_slideIn 0.3s ease-out;
}

@keyframes sendV_slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

/* Results List Styles */
.sendV_results_list li {
    padding: 12px 16px;
    cursor: pointer;
    border-bottom: 1px solid #e5e7eb;
    transition: background 0.2s ease;
}

.sendV_results_list li:hover {
    background: #f0f4ff;
}

.sendV_results_list li:last-child {
    border-bottom: none;
}
</style>

<script>
// Simplified Email Sender JavaScript
let sendV_recipientCount = 1;
let sendV_attachedFiles = [];
let sendV_sentMessagesVisible = false;

// Initialize the form
document.addEventListener('DOMContentLoaded', function() {
    sendV_initializeForm();
    sendV_initializeFileUpload();
    sendV_initializePatientSearch();
});

function sendV_initializeForm() {
    // Handle quick select radio buttons
    document.querySelectorAll('input[name="quick_select"]').forEach(radio => {
        radio.addEventListener('change', function() {
            sendV_handleQuickSelect(this.value);
        });
    });

    // Handle form submission
    document.getElementById('sendV_email_form').addEventListener('submit', function(e) {
        e.preventDefault();
        sendV_sendEmail();
    });

    // Sync editor content with hidden textarea
    document.getElementById('sendV_message_editor').addEventListener('input', function() {
        document.getElementById('sendV_message_hidden').value = this.innerHTML;
    });
}

function sendV_initializePatientSearch() {
    const searchInput = document.getElementById('sendV_patient_search');
    const resultsList = document.getElementById('sendV_patient_results');
    const patientIdInput = document.getElementById('sendV_patient_id');

    searchInput.addEventListener('keyup', function(e) {
        const query = e.target.value.trim();
        if (query.length < 2) {
            resultsList.style.display = 'none';
            return;
        }

        fetch(`https://secure-emr.ispecsappeal.net/email_handler.php?action=search_patients&query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                resultsList.innerHTML = '';
                if (data.success && data.patients && data.patients.length > 0) {
                    data.patients.forEach(patient => {
                        const li = document.createElement('li');
                        li.textContent = `${patient.first_name} ${patient.last_name} (${patient.email})`;
                        li.dataset.id = patient.id;
                        li.dataset.email = patient.email;
                        li.dataset.name = patient.name;
                        li.addEventListener('click', function() {
                            searchInput.value = `${patient.first_name} ${patient.last_name} (${patient.email})`;
                            patientIdInput.value = patient.id;
                            resultsList.style.display = 'none';
                        });
                        resultsList.appendChild(li);
                    });
                    resultsList.style.display = 'block';
                } else {
                    resultsList.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error searching patients:', error);
            });
    });

    // Hide results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
            resultsList.style.display = 'none';
        }
    });
}

function sendV_showSentMessages() {
    const sentSection = document.getElementById('sendV_sent_messages');
    const content = document.getElementById('sendV_sent_messages_content');
    const form = document.getElementById('sendV_email_form');

    sendV_sentMessagesVisible = !sendV_sentMessagesVisible;

    if (sendV_sentMessagesVisible) {
        sentSection.style.display = 'block';
        form.style.display = 'none';

        // Fetch sent messages
        fetch('https://secure-emr.ispecsappeal.net/email_handler.php?action=get_sent_messages')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.logs) {
                    let table = '<table style="width: 100%; border-collapse: collapse;"><thead><tr><th style="border: 1px solid #ddd; padding: 8px;">Recipient</th><th style="border: 1px solid #ddd; padding: 8px;">Subject</th><th style="border: 1px solid #ddd; padding: 8px;">Status</th><th style="border: 1px solid #ddd; padding: 8px;">Sent At</th></tr></thead><tbody>';
                    data.logs.forEach(log => {
                        table += `<tr><td style="border: 1px solid #ddd; padding: 8px;">${log.recipient_name} (${log.recipient_email})</td><td style="border: 1px solid #ddd; padding: 8px;">${log.subject}</td><td style="border: 1px solid #ddd; padding: 8px;">${log.status}</td><td style="border: 1px solid #ddd; padding: 8px;">${log.sent_at}</td></tr>`;
                    });
                    table += '</tbody></table>';
                    content.innerHTML = table;
                } else {
                    content.innerHTML = '<p>No sent messages found.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching sent messages:', error);
                content.innerHTML = '<p>Error loading sent messages.</p>';
            });
    } else {
        sentSection.style.display = 'none';
        form.style.display = 'block';
    }
}

function sendV_addRecipient() {
    if (sendV_recipientCount >= 10) {
        sendV_showAlert('error', 'Maximum 10 recipients allowed');
        return;
    }

    sendV_recipientCount++;
    const container = document.querySelector('.sendV_recipient_group');  // Note: Changed from .sendV_recipients_container to allow single group
    const newGroup = document.createElement('div');
    newGroup.className = 'sendV_recipient_group sendV_slide_in';
    
    newGroup.innerHTML = `
        <label class="sendV_label">
            <input type="email" class="sendV_input sendV_email_input" name="recipients[]" placeholder="Enter email address" required>
            <button type="button" class="sendV_btn_remove" onclick="sendV_removeRecipient(this)">×</button>
        </label>
    `;
    
    container.appendChild(newGroup);
    sendV_updateRecipientCount();
    
    // Show remove buttons for all recipients when there's more than one
    if (sendV_recipientCount > 1) {
        document.querySelectorAll('.sendV_btn_remove').forEach(btn => {
            btn.style.display = 'inline-block';
        });
    }
    
    // Hide add button if we've reached the limit
    if (sendV_recipientCount >= 10) {
        document.getElementById('sendV_add_recipient').style.display = 'none';
    }
}

function sendV_removeRecipient(button) {
    if (sendV_recipientCount <= 1) return;
    
    button.closest('.sendV_recipient_group').remove();
    sendV_recipientCount--;
    sendV_updateRecipientCount();
    
    // Hide remove buttons if only one recipient remains
    if (sendV_recipientCount === 1) {
        document.querySelectorAll('.sendV_btn_remove').forEach(btn => {
            btn.style.display = 'none';
        });
    }
    
    // Show add button if we're under the limit
    if (sendV_recipientCount < 10) {
        document.getElementById('sendV_add_recipient').style.display = 'inline-flex';
    }
}

function sendV_updateRecipientCount() {
    document.getElementById('sendV_count').textContent = sendV_recipientCount;
}

function sendV_handleQuickSelect(value) {
    // Hide all conditional fields
    document.querySelectorAll('.sendV_conditional_field').forEach(field => {
        field.style.display = 'none';
    });
    
    // Show relevant field
    if (value === 'single_patient') {
        document.getElementById('sendV_single_patient').style.display = 'block';
    }
    
    // Clear manual recipients if quick select is used
    if (value !== '') {
        const recipientsContainer = document.querySelector('.sendV_recipient_group');
        recipientsContainer.innerHTML = '';
        sendV_recipientCount = 0;
        document.getElementById('sendV_add_recipient').style.display = 'none';
    } else {
        // Reset manual recipients if switching back
        const recipientsContainer = document.querySelector('.sendV_recipient_group');
        recipientsContainer.innerHTML = `
            <label class="sendV_label">
                <input type="email" class="sendV_input sendV_email_input" name="recipients[]" placeholder="Enter email address" required>
                <button type="button" class="sendV_btn_remove" onclick="sendV_removeRecipient(this)" style="display: none;">×</button>
            </label>
        `;
        sendV_recipientCount = 1;
        sendV_updateRecipientCount();
        document.getElementById('sendV_add_recipient').style.display = 'inline-flex';
    }
}

function sendV_addShortcode(shortcode) {
    const editor = document.getElementById('sendV_message_editor');
    const selection = window.getSelection();
    
    if (selection.rangeCount > 0 && editor.contains(selection.anchorNode)) {
        const range = selection.getRangeAt(0);
        range.deleteContents();
        range.insertNode(document.createTextNode(shortcode));
        range.collapse(false);
    } else {
        editor.innerHTML += shortcode;
    }
    
    // Update hidden textarea
    document.getElementById('sendV_message_hidden').value = editor.innerHTML;
    editor.focus();
}

function sendV_formatText(command) {
    document.execCommand(command, false, null);
    document.getElementById('sendV_message_hidden').value = document.getElementById('sendV_message_editor').innerHTML;
}

function sendV_initializeFileUpload() {
    const fileInput = document.getElementById('sendV_file_input');
    const dropZone = document.querySelector('.sendV_file_drop_zone');
    
    // Handle file selection
    fileInput.addEventListener('change', function(e) {
        sendV_handleFiles(e.target.files);
    });
    
    // Handle drag and drop
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.style.borderColor = '#667eea';
        dropZone.style.background = '#f0f4ff';
    });
    
    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.style.borderColor = '#d1d5db';
        dropZone.style.background = '#fafafa';
    });
    
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.style.borderColor = '#d1d5db';
        dropZone.style.background = '#fafafa';
        sendV_handleFiles(e.dataTransfer.files);
    });
}

function sendV_handleFiles(files) {
    const maxSize = 10 * 1024 * 1024; // 10MB
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf', 
                          'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                          'text/plain', 'application/zip'];
    
    Array.from(files).forEach(file => {
        // Validate file size
        if (file.size > maxSize) {
            sendV_showAlert('error', `File "${file.name}" is too large. Maximum size is 10MB.`);
            return;
        }
        
        // Validate file type
        if (!allowedTypes.includes(file.type)) {
            sendV_showAlert('error', `File "${file.name}" type is not supported.`);
            return;
        }
        
        // Check if file already exists
        if (sendV_attachedFiles.find(f => f.name === file.name && f.size === file.size)) {
            sendV_showAlert('error', `File "${file.name}" is already attached.`);
            return;
        }
        
        sendV_attachedFiles.push(file);
        sendV_displayFile(file);
    });
}

function sendV_displayFile(file) {
    const fileList = document.getElementById('sendV_file_list');
    const fileItem = document.createElement('div');
    fileItem.className = 'sendV_file_item sendV_fade_in';
    
    const fileSize = sendV_formatFileSize(file.size);
    const fileIcon = sendV_getFileIcon(file.type);
    
    fileItem.innerHTML = `
        <div class="sendV_file_info">
            <span class="sendV_icon">${fileIcon}</span>
            <div>
                <div style="font-weight: 500;">${file.name}</div>
                <small style="color: #6b7280;">${fileSize}</small>
            </div>
        </div>
        <button type="button" class="sendV_file_remove" onclick="sendV_removeFile('${file.name}', this)">Remove</button>
    `;
    
    fileList.appendChild(fileItem);
}

function sendV_removeFile(fileName, button) {
    sendV_attachedFiles = sendV_attachedFiles.filter(file => file.name !== fileName);
    button.closest('.sendV_file_item').remove();
}

function sendV_formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function sendV_getFileIcon(type) {
    if (type.startsWith('image/')) return '🖼️';
    if (type === 'application/pdf') return '📄';
    if (type.includes('word')) return '📝';
    if (type === 'text/plain') return '📄';
    if (type === 'application/zip') return '📦';
    return '📎';
}

function sendV_sendEmail() {
    // Show loading state
    sendV_showLoading(true);
    sendV_showProgress(true);
    
    // Prepare form data
    const formData = new FormData();
    
    // Get form data
    const quickSelect = document.querySelector('input[name="quick_select"]:checked');
    const subject = document.getElementById('sendV_subject').value;
    const message = document.getElementById('sendV_message_hidden').value;
    
    // Validate required fields
    if (!subject.trim()) {
        sendV_showAlert('error', 'Please enter a subject');
        sendV_showLoading(false);
        sendV_showProgress(false);
        return;
    }
    
    if (!message.trim()) {
        sendV_showAlert('error', 'Please enter a message');
        sendV_showLoading(false);
        sendV_showProgress(false);
        return;
    }
    
    // Add action and basic form data
    formData.append('action', 'send_email');
    formData.append('subject', subject);
    formData.append('message', message);
    
    // Handle recipients
    if (quickSelect) {
        formData.append('send_type', quickSelect.value);
        if (quickSelect.value === 'single_patient') {
            const patientId = document.getElementById('sendV_patient_id').value;
            if (!patientId) {
                sendV_showAlert('error', 'Please select a patient');
                sendV_showLoading(false);
                sendV_showProgress(false);
                return;
            }
            formData.append('patient_id', patientId);
        }
    } else {
        // Manual recipients
        const recipients = [];
        document.querySelectorAll('.sendV_email_input').forEach(input => {
            if (input.value.trim()) {
                recipients.push(input.value.trim());
            }
        });
        
        if (recipients.length === 0) {
            sendV_showAlert('error', 'Please enter at least one recipient email');
            sendV_showLoading(false);
            sendV_showProgress(false);
            return;
        }
        
        formData.append('send_type', 'manual');
        formData.append('recipients', JSON.stringify(recipients));
    }
    
    // Add attachments
    sendV_attachedFiles.forEach((file, index) => {
        formData.append(`attachments[${index}]`, file);
    });
    
    // Send the email
    fetch('https://secure-emr.ispecsappeal.net/email_handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        sendV_showLoading(false);
        sendV_showProgress(false);
        
        if (data.success) {
            sendV_showAlert('success', data.message || 'Email sent successfully!');
            sendV_resetForm();
        } else {
            sendV_showAlert('error', data.message || 'Failed to send email. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        sendV_showLoading(false);
        sendV_showProgress(false);
        sendV_showAlert('error', 'An error occurred while sending the email. Please try again.');
    });
}

function sendV_showLoading(show) {
    const submitBtn = document.getElementById('sendV_submit_btn');
    const sendingStatus = document.getElementById('sendV_sending_status');
    
    if (show) {
        submitBtn.style.display = 'none';
        sendingStatus.style.display = 'flex';
    } else {
        submitBtn.style.display = 'inline-flex';
        sendingStatus.style.display = 'none';
    }
}

function sendV_showProgress(show) {
    const progressContainer = document.getElementById('sendV_progress_container');
    const progressFill = document.getElementById('sendV_progress_fill');
    const progressText = document.getElementById('sendV_progress_text');
    
    if (show) {
        progressContainer.style.display = 'block';
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress > 90) progress = 90;
            progressFill.style.width = progress + '%';
            progressText.textContent = `Sending email... ${Math.round(progress)}%`;
        }, 500);
        
        // Store interval ID for cleanup
        progressContainer.dataset.intervalId = interval;
    } else {
        if (progressContainer.dataset.intervalId) {
            clearInterval(progressContainer.dataset.intervalId);
        }
        progressFill.style.width = '100%';
        progressText.textContent = 'Email sent successfully!';
        setTimeout(() => {
            progressContainer.style.display = 'none';
            progressFill.style.width = '0%';
        }, 2000);
    }
}

function sendV_showAlert(type, message) {
    const alertId = type === 'success' ? 'sendV_success_alert' : 'sendV_error_alert';
    const messageId = type === 'success' ? 'sendV_success_message' : 'sendV_error_message';
    
    document.getElementById(messageId).textContent = message;
    document.getElementById(alertId).style.display = 'flex';
    document.getElementById(alertId).classList.add('sendV_fade_in');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        document.getElementById(alertId).style.display = 'none';
    }, 5000);
}

function sendV_resetForm() {
    // Reset form fields
    document.getElementById('sendV_email_form').reset();
    document.getElementById('sendV_message_editor').innerHTML = '';
    document.getElementById('sendV_message_hidden').value = '';
    
    // Reset recipients
    const container = document.querySelector('.sendV_recipient_group');
    container.innerHTML = `
        <label class="sendV_label">
            <input type="email" class="sendV_input sendV_email_input" name="recipients[]" placeholder="Enter email address" required>
            <button type="button" class="sendV_btn_remove" onclick="sendV_removeRecipient(this)" style="display: none;">×</button>
        </label>
    `;
    sendV_recipientCount = 1;
    sendV_updateRecipientCount();
    
    // Reset files
    sendV_attachedFiles = [];
    document.getElementById('sendV_file_list').innerHTML = '';
    
    // Reset quick select
    document.querySelectorAll('input[name="quick_select"]').forEach(radio => {
        radio.checked = false;
    });
    document.querySelectorAll('.sendV_conditional_field').forEach(field => {
        field.style.display = 'none';
    });
    
    // Reset patient search
    document.getElementById('sendV_patient_search').value = '';
    document.getElementById('sendV_patient_id').value = '';
    document.getElementById('sendV_patient_results').style.display = 'none';
    
    // Show add recipient button
    document.getElementById('sendV_add_recipient').style.display = 'inline-flex';
}
</script>

<!--main content end-->