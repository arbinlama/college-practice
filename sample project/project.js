let courses = JSON.parse(localStorage.getItem('courses')) || [];
let subsidies = JSON.parse(localStorage.getItem('subsidies')) || [];

// Form validation and submission for Training Courses
document.getElementById('trainingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const duration = document.getElementById('duration').value;

    if (title.length < 3) {
        alert('Title must be at least 3 characters long');
        return;
    }

    const course = {
        id: Date.now(),
        title,
        description,
        duration
    };

    courses.push(course);
    localStorage.setItem('courses', JSON.stringify(courses));
    this.reset();
    displayCourses();
});

// Form validation and submission for Subsidies
document.getElementById('subsidyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const scheme = document.getElementById('scheme').value.trim();
    const eligibility = document.getElementById('eligibility').value.trim();
    const amount = document.getElementById('amount').value;

    if (scheme.length < 3) {
        alert('Scheme name must be at least 3 characters long');
        return;
    }

    const subsidy = {
        id: Date.now(),
        scheme,
        eligibility,
        amount
    };

    subsidies.push(subsidy);
    localStorage.setItem('subsidies', JSON.stringify(subsidies));
    this.reset();
    displaySubsidies();
});

// Display functions
function displayCourses() {
    const coursesList = document.getElementById('coursesList');
    coursesList.innerHTML = courses.map(course => `
        <div class="card">
            <h4>${course.title}</h4>
            <p>${course.description}</p>
            <p>Duration: ${course.duration} hours</p>
            <button onclick="deleteCourse(${course.id})" class="btn">Delete</button>
            <button onclick="editCourse(${course.id})" class="btn">Edit</button>
        </div>
    `).join('');
}

function displaySubsidies() {
    const subsidiesList = document.getElementById('subsidiesList');
    subsidiesList.innerHTML = subsidies.map(subsidy => `
        <div class="card">
            <h4>${subsidy.scheme}</h4>
            <p>${subsidy.eligibility}</p>
            <p>Amount: ₹${subsidy.amount}</p>
            <button onclick="deleteSubsidy(${subsidy.id})" class="btn">Delete</button>
            <button onclick="editSubsidy(${subsidy.id})" class="btn">Edit</button>
        </div>
    `).join('');
}

// CRUD Operations
function deleteCourse(id) {
    if(confirm('Are you sure you want to delete this course?')) {
        courses = courses.filter(course => course.id !== id);
        localStorage.setItem('courses', JSON.stringify(courses));
        displayCourses();
    }
}

function deleteSubsidy(id) {
    if(confirm('Are you sure you want to delete this subsidy?')) {
        subsidies = subsidies.filter(subsidy => subsidy.id !== id);
        localStorage.setItem('subsidies', JSON.stringify(subsidies));
        displaySubsidies();
    }
}

function editCourse(id) {
    const course = courses.find(c => c.id === id);
    if(course) {
        document.getElementById('title').value = course.title;
        document.getElementById('description').value = course.description;
        document.getElementById('duration').value = course.duration;
        deleteCourse(id);
    }
}

function editSubsidy(id) {
    const subsidy = subsidies.find(s => s.id === id);
    if(subsidy) {
        document.getElementById('scheme').value = subsidy.scheme;
        document.getElementById('eligibility').value = subsidy.eligibility;
        document.getElementById('amount').value = subsidy.amount;
        deleteSubsidy(id);
    }
}