<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Dashboard - SkillUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Top Navigation -->
    <nav class="bg-indigo-600 text-white px-6 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">SkillUp Instructor</h1>
            <div class="flex items-center gap-4">
                <span>Welcome, John Doe</span>
                <a href="#" class="bg-indigo-700 px-4 py-2 rounded hover:bg-indigo-800">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            Welcome to your dashboard! Your last course was successfully published.
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 mb-2">Total Students</h3>
                <p class="text-2xl font-bold">1,234</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 mb-2">Total Courses</h3>
                <p class="text-2xl font-bold">12</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 mb-2">Pending Courses</h3>
                <p class="text-2xl font-bold">3</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 mb-2">Active Courses</h3>
                <p class="text-2xl font-bold">9</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <button onclick="document.getElementById('addCourseModal').classList.remove('hidden')" 
                    class="bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600">
                <i class="fas fa-plus mr-2"></i>Add New Course
            </button>
        </div>

        <!-- Course List -->
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Sample Course Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="/api/placeholder/400/320" alt="Course Thumbnail" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-2">Introduction to Web Development</h2>
                        <p class="text-gray-600 mb-4">Learn the basics of HTML, CSS, and JavaScript in this comprehensive course.</p>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">Beginner</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Web Development</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-sm">Video</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">
                                <i class="fas fa-clock mr-1"></i>6 weeks
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">#webdev</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">#html</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">#css</span>
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-users mr-2"></i>156 students
                            </span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Accepted</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="space-x-2">
                                <button class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <button class="inline-block px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                <i class="fas fa-users mr-1"></i>View Students
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sample Course Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="/api/placeholder/400/320" alt="Course Thumbnail" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-2">Advanced Python Programming</h2>
                        <p class="text-gray-600 mb-4">Master Python with advanced concepts and real-world applications.</p>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">Advanced</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Programming</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-sm">Document</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">
                                <i class="fas fa-clock mr-1"></i>8 weeks
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">#python</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">#programming</span>
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-users mr-2"></i>89 students
                            </span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">Pending</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="space-x-2">
                                <button class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <button class="inline-block px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                <i class="fas fa-users mr-1"></i>View Students
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div id="addCourseModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-2/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Add New Course</h3>
                <form action="#" method="POST">
                    <!-- Basic Course Information -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input type="text" name="title" required 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <select name="category_id" required class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                <option value="1">Web Development</option>
                                <option value="2">Programming</option>
                                <option value="3">Data Science</option>
                            </select>
                        </div>
                    </div>

                    <!-- Course Description -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea name="description" required rows="4"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></textarea>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end gap-4 mt-6">
                        <button type="button" onclick="document.getElementById('addCourseModal').classList.add('hidden')"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">
                            Create Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
                alerts.forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease-in-out';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 3000);
        });
    </script>
</body>
</html>