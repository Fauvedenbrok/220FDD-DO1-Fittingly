class FittinglyLearningEnvironment {
    constructor() {
        this.currentMode = 'explain';
        this.currentDifficulty = 'intermediate';
        this.currentQuestionIndex = 0;
        this.score = 0;
        this.totalQuestions = 0;
        this.streak = 0;
        this.studyNotes = [];
        
        this.questions = this.generateQuestions();
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadQuestion();
        this.updateStats();
    }

    setupEventListeners() {
        // Mode selection
        document.querySelectorAll('.mode-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('active'));
                e.target.classList.add('active');
                this.currentMode = e.target.dataset.mode;
                this.resetQuiz();
            });
        });

        // Difficulty selection
        document.getElementById('difficulty').addEventListener('change', (e) => {
            this.currentDifficulty = e.target.value;
            this.resetQuiz();
        });

        // Answer submission
        document.getElementById('submit-btn').addEventListener('click', () => {
            this.submitAnswer();
        });

        // Hint button
        document.getElementById('hint-btn').addEventListener('click', () => {
            this.showHint();
        });

        // Next question
        document.getElementById('next-btn').addEventListener('click', () => {
            this.nextQuestion();
        });

        // Answer option selection
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('answer-option')) {
                document.querySelectorAll('.answer-option').forEach(opt => opt.classList.remove('selected'));
                e.target.classList.add('selected');
            }
        });
    }

    generateQuestions() {
        return {
            explain: {
                beginner: [
                    {
                        title: "Basic PHP Class Structure",
                        code: `<?php
class Addresses {
    private string $postalCode;
    private string $houseNumber;
    
    public function __construct(string $postalCode, string $houseNumber) {
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
    }
}`,
                        question: "What does this code do?",
                        options: [
                            "Creates a database table for addresses",
                            "Defines a PHP class to represent address data with private properties",
                            "Connects to the database",
                            "Validates postal codes"
                        ],
                        correct: 1,
                        explanation: "This code defines a PHP class called 'Addresses' with private properties for postal code and house number, and a constructor to initialize these values.",
                        hint: "Look at the class keyword and the private properties.",
                        studyNote: "PHP classes use the 'class' keyword. Private properties can only be accessed within the same class."
                    },
                    {
                        title: "Session Management",
                        code: `<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['user_email'] = $email;`,
                        question: "What is this code doing?",
                        options: [
                            "Destroying a session",
                            "Checking if a session exists, starting one if needed, and storing user email",
                            "Validating user credentials",
                            "Logging out a user"
                        ],
                        correct: 1,
                        explanation: "This code checks if a session is already active, starts one if not, and then stores the user's email in the session.",
                        hint: "Look at session_start() and $_SESSION usage.",
                        studyNote: "Always check if a session is already started before calling session_start() to avoid errors."
                    }
                ],
                intermediate: [
                    {
                        title: "CRUD Operations",
                        code: `public static function createData(string $table, array $data) {
    $pdo = Database::getConnection();
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), "?"));
    $query = "INSERT INTO {$table} ($columns) VALUES ($placeholders)";
    $stmt = $pdo->prepare($query);
    return $stmt->execute(array_values($data));
}`,
                        question: "What security feature is this code implementing?",
                        options: [
                            "SQL injection prevention through prepared statements",
                            "Password hashing",
                            "CSRF protection",
                            "Input validation"
                        ],
                        correct: 0,
                        explanation: "This code uses prepared statements with placeholders (?) to prevent SQL injection attacks by separating SQL code from data.",
                        hint: "Look at the ? placeholders and prepare() method.",
                        studyNote: "Prepared statements are crucial for preventing SQL injection. Never concatenate user input directly into SQL queries."
                    },
                    {
                        title: "MVC Pattern - Controller",
                        code: `$data = require_once __DIR__ . '/../project_root/Controllers/product_list_controller.php';
extract($data);
require_once __DIR__ . '/views/product_list_view.php';`,
                        question: "What design pattern is being implemented here?",
                        options: [
                            "Singleton Pattern",
                            "Factory Pattern", 
                            "Model-View-Controller (MVC) Pattern",
                            "Observer Pattern"
                        ],
                        correct: 2,
                        explanation: "This shows the MVC pattern where the controller processes data and passes it to the view for display.",
                        hint: "Notice the separation between controller logic and view presentation.",
                        studyNote: "MVC separates concerns: Model (data), View (presentation), Controller (logic)."
                    }
                ],
                advanced: [
                    {
                        title: "Dependency Injection",
                        code: `public function __construct(
    string $postalCode,
    string $houseNumber,
    string $streetName,
    string $city,
    string $country,
    $crudModel = null
) {
    // ... property assignments
    $this->crudModel = $crudModel ?? new \\Models\\CrudModel();
}`,
                        question: "What design principle is demonstrated here?",
                        options: [
                            "Inheritance",
                            "Dependency Injection with default fallback",
                            "Polymorphism",
                            "Encapsulation"
                        ],
                        correct: 1,
                        explanation: "This shows dependency injection where dependencies can be injected, with a fallback to create a default instance if none is provided.",
                        hint: "Look at the optional parameter and null coalescing operator (??).",
                        studyNote: "Dependency injection makes code more testable and flexible by allowing dependencies to be provided externally."
                    }
                ]
            },
            identify: {
                beginner: [
                    {
                        title: "Identify the Purpose",
                        code: `if (!Session::exists('user_email')) {
    header('Location: inloggen.php');
    exit;
}`,
                        question: "What is this code checking for?",
                        type: "input",
                        correctAnswer: "user authentication",
                        explanation: "This code checks if a user is logged in by verifying if their email exists in the session. If not, it redirects to the login page.",
                        hint: "Think about what happens when a user isn't logged in.",
                        studyNote: "Authentication checks are crucial for protecting restricted pages."
                    }
                ],
                intermediate: [
                    {
                        title: "Database Pattern Recognition",
                        code: `$stmt = $pdo->prepare("SELECT * FROM {$tableName} WHERE {$columnName} = ?");
$stmt->execute([$value]);
return $stmt->fetchAll(PDO::FETCH_ASSOC);`,
                        question: "What database operation pattern is this?",
                        type: "input",
                        correctAnswer: "prepared statement query",
                        explanation: "This is a prepared statement pattern for safely querying a database with user input.",
                        hint: "Look at the prepare() and execute() methods.",
                        studyNote: "Prepared statements separate SQL structure from data, preventing injection attacks."
                    }
                ]
            },
            debug: {
                beginner: [
                    {
                        title: "Find the Bug",
                        code: `<?php
class CartHandler {
    public function addToCart(int $productId, int $quantity): void {
        $_SESSION['cart'][$productId] = $_SESSION['cart'][$productId] + $quantity;
    }
}`,
                        question: "What's wrong with this code?",
                        options: [
                            "Missing session_start()",
                            "No check if $_SESSION['cart'] exists",
                            "Wrong parameter types",
                            "Missing return statement"
                        ],
                        correct: 1,
                        explanation: "The code doesn't check if $_SESSION['cart'] or $_SESSION['cart'][$productId] exists before trying to access them, which will cause errors.",
                        hint: "What happens if the cart doesn't exist yet?",
                        studyNote: "Always check if array keys exist before accessing them to avoid undefined index errors."
                    }
                ],
                intermediate: [
                    {
                        title: "Security Vulnerability",
                        code: `$query = "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'";
$result = $pdo->query($query);`,
                        question: "What security issue does this code have?",
                        options: [
                            "Missing error handling",
                            "SQL injection vulnerability",
                            "No input validation",
                            "All of the above"
                        ],
                        correct: 3,
                        explanation: "This code is vulnerable to SQL injection because it directly concatenates user input into the query. It also lacks input validation and error handling.",
                        hint: "Never trust user input directly in SQL queries.",
                        studyNote: "Always use prepared statements and validate input to prevent SQL injection attacks."
                    }
                ]
            },
            complete: {
                beginner: [
                    {
                        title: "Complete the Constructor",
                        code: `class Articles {
    private int $articleID;
    private string $articleName;
    
    public function __construct(int $articleID, string $articleName) {
        // Complete this constructor
        $this->______ = $articleID;
        $this->______ = $articleName;
    }
}`,
                        question: "Fill in the blanks to complete the constructor:",
                        type: "input",
                        correctAnswer: "articleID, articleName",
                        explanation: "The constructor should assign the parameters to the corresponding private properties using $this->.",
                        hint: "Use $this-> to access object properties.",
                        studyNote: "Constructors initialize object properties when an instance is created."
                    }
                ],
                intermediate: [
                    {
                        title: "Complete the Validation",
                        code: `public static function isValidEmail(string $email): bool {
    return ______(______, FILTER_VALIDATE_EMAIL) !== false;
}`,
                        question: "Complete this email validation function:",
                        type: "input",
                        correctAnswer: "filter_var, $email",
                        explanation: "The filter_var() function with FILTER_VALIDATE_EMAIL is the standard way to validate email addresses in PHP.",
                        hint: "PHP has a built-in function for filtering and validating data.",
                        studyNote: "filter_var() is PHP's built-in function for validating and sanitizing data."
                    }
                ]
            }
        };
    }

    resetQuiz() {
        this.currentQuestionIndex = 0;
        this.score = 0;
        this.totalQuestions = 0;
        this.streak = 0;
        this.updateStats();
        this.loadQuestion();
    }

    loadQuestion() {
        const questions = this.questions[this.currentMode][this.currentDifficulty];
        if (!questions || this.currentQuestionIndex >= questions.length) {
            this.showCompletion();
            return;
        }

        const question = questions[this.currentQuestionIndex];
        this.totalQuestions = questions.length;

        document.getElementById('question-title').textContent = question.title;
        document.getElementById('question-number').textContent = `Question ${this.currentQuestionIndex + 1}/${this.totalQuestions}`;
        document.getElementById('code-display').textContent = question.code;
        document.getElementById('question-text').textContent = question.question;

        // Clear previous state
        document.getElementById('feedback').innerHTML = '';
        document.getElementById('hint').style.display = 'none';
        document.getElementById('submit-btn').style.display = 'inline-block';
        document.getElementById('next-btn').style.display = 'none';

        // Setup answer interface based on question type
        if (question.type === 'input') {
            document.getElementById('answer-options').innerHTML = '';
            document.getElementById('user-input').style.display = 'block';
            document.getElementById('user-answer').value = '';
        } else {
            document.getElementById('user-input').style.display = 'none';
            this.setupMultipleChoice(question);
        }

        this.updateProgress();
    }

    setupMultipleChoice(question) {
        const optionsContainer = document.getElementById('answer-options');
        optionsContainer.innerHTML = '';

        question.options.forEach((option, index) => {
            const optionDiv = document.createElement('div');
            optionDiv.className = 'answer-option';
            optionDiv.textContent = option;
            optionDiv.dataset.index = index;
            optionsContainer.appendChild(optionDiv);
        });
    }

    submitAnswer() {
        const questions = this.questions[this.currentMode][this.currentDifficulty];
        const question = questions[this.currentQuestionIndex];
        let userAnswer;
        let isCorrect = false;

        if (question.type === 'input') {
            userAnswer = document.getElementById('user-answer').value.trim().toLowerCase();
            const correctAnswers = question.correctAnswer.toLowerCase().split(',').map(a => a.trim());
            isCorrect = correctAnswers.some(answer => userAnswer.includes(answer));
        } else {
            const selectedOption = document.querySelector('.answer-option.selected');
            if (!selectedOption) {
                alert('Please select an answer!');
                return;
            }
            userAnswer = parseInt(selectedOption.dataset.index);
            isCorrect = userAnswer === question.correct;
        }

        this.showFeedback(isCorrect, question);
        this.updateScore(isCorrect);
        this.addStudyNote(question);

        document.getElementById('submit-btn').style.display = 'none';
        document.getElementById('next-btn').style.display = 'inline-block';
    }

    showFeedback(isCorrect, question) {
        const feedback = document.getElementById('feedback');
        
        if (isCorrect) {
            feedback.className = 'feedback correct';
            feedback.innerHTML = `✅ Correct! ${question.explanation}`;
            if (!question.type || question.type !== 'input') {
                document.querySelectorAll('.answer-option').forEach((opt, index) => {
                    if (index === question.correct) {
                        opt.classList.add('correct');
                    }
                });
            }
        } else {
            feedback.className = 'feedback incorrect';
            feedback.innerHTML = `❌ Incorrect. ${question.explanation}`;
            if (!question.type || question.type !== 'input') {
                document.querySelectorAll('.answer-option').forEach((opt, index) => {
                    if (opt.classList.contains('selected')) {
                        opt.classList.add('incorrect');
                    }
                    if (index === question.correct) {
                        opt.classList.add('correct');
                    }
                });
            }
        }
    }

    showHint() {
        const questions = this.questions[this.currentMode][this.currentDifficulty];
        const question = questions[this.currentQuestionIndex];
        
        const hintDiv = document.getElementById('hint');
        hintDiv.innerHTML = `💡 <strong>Hint:</strong> ${question.hint}`;
        hintDiv.style.display = 'block';
    }

    updateScore(isCorrect) {
        if (isCorrect) {
            this.score++;
            this.streak++;
        } else {
            this.streak = 0;
        }
        this.updateStats();
    }

    updateStats() {
        document.getElementById('score').textContent = `Score: ${this.score}/${this.totalQuestions}`;
        document.getElementById('streak').textContent = `Streak: ${this.streak}`;
    }

    updateProgress() {
        const progress = ((this.currentQuestionIndex + 1) / this.totalQuestions) * 100;
        document.getElementById('progress-fill').style.width = `${progress}%`;
    }

    addStudyNote(question) {
        if (question.studyNote && !this.studyNotes.includes(question.studyNote)) {
            this.studyNotes.push(question.studyNote);
            this.updateStudyNotes();
        }
    }

    updateStudyNotes() {
        const notesContainer = document.getElementById('notes-content');
        if (this.studyNotes.length === 0) {
            notesContainer.innerHTML = '<p>Notes will appear here as you complete questions...</p>';
            return;
        }

        notesContainer.innerHTML = this.studyNotes.map(note => 
            `<div class="note-item">${note}</div>`
        ).join('');
    }

    nextQuestion() {
        this.currentQuestionIndex++;
        this.loadQuestion();
    }

    showCompletion() {
        const percentage = Math.round((this.score / this.totalQuestions) * 100);
        let message = '';
        
        if (percentage >= 90) {
            message = '🎉 Excellent! You have a strong understanding of the code!';
        } else if (percentage >= 70) {
            message = '👍 Good job! Review the study notes for areas to improve.';
        } else if (percentage >= 50) {
            message = '📚 Keep studying! Focus on the concepts you missed.';
        } else {
            message = '💪 Don\'t give up! Review the material and try again.';
        }

        document.querySelector('.question-container').innerHTML = `
            <div style="text-align: center; padding: 40px;">
                <h2>Quiz Complete!</h2>
                <div style="font-size: 3rem; margin: 20px 0;">${percentage}%</div>
                <p style="font-size: 1.2rem; margin-bottom: 30px;">${message}</p>
                <button onclick="location.reload()" style="background: #cc9c4e; color: #1a3030; border: none; padding: 15px 30px; border-radius: 25px; font-size: 1.1rem; cursor: pointer;">
                    Start Over
                </button>
            </div>
        `;
    }
}

// Initialize the learning environment when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new FittinglyLearningEnvironment();
});