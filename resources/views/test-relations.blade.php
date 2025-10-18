<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Relations - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Database Relationship Test</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Test Relations Button -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Test Basic Relations</h2>
                <p class="text-gray-600 mb-4">Test the relationship between pengguna and pengguna_registered tables</p>
                <button onclick="testRelations()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Test Relations
                </button>
                <div id="relations-result" class="mt-4 p-4 bg-gray-50 rounded hidden"></div>
            </div>

            <!-- Show All Users Button -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Show All Users with Profiles</h2>
                <p class="text-gray-600 mb-4">Display all users and their registered profile data</p>
                <button onclick="showUsersProfiles()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Show Users & Profiles
                </button>
                <div id="users-result" class="mt-4 p-4 bg-gray-50 rounded hidden"></div>
            </div>
        </div>

        <!-- Relationship Documentation -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Relationship Documentation</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-lg mb-2">Pengguna Model</h3>
                    <pre class="bg-gray-100 p-4 rounded text-sm"><code>// One-to-One relationship
public function registeredProfile()
{
    return $this->hasOne(
        PenggunaRegistered::class, 
        'pengguna_id'
    );
}

// Usage:
$user = Pengguna::find(1);
$profile = $user->registeredProfile;
</code></pre>
                </div>

                <div>
                    <h3 class="font-semibold text-lg mb-2">PenggunaRegistered Model</h3>
                    <pre class="bg-gray-100 p-4 rounded text-sm"><code>// Inverse relationship
public function pengguna()
{
    return $this->belongsTo(
        Pengguna::class, 
        'pengguna_id'
    );
}

// Usage:
$profile = PenggunaRegistered::find(1);
$user = $profile->pengguna;
</code></pre>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="font-semibold text-lg mb-2">Database Structure</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-medium mb-2">pengguna table:</h4>
                        <ul class="text-sm text-gray-600 list-disc list-inside">
                            <li>id (Primary Key)</li>
                            <li>first_name</li>
                            <li>last_name</li>
                            <li>email</li>
                            <li>phone_number</li>
                            <li>country</li>
                            <li>password</li>
                            <li>verified</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-medium mb-2">pengguna_registered table:</h4>
                        <ul class="text-sm text-gray-600 list-disc list-inside">
                            <li>id (Primary Key)</li>
                            <li>pengguna_id (Foreign Key)</li>
                            <li>profile_picture</li>
                            <li>date_of_birth</li>
                            <li>gender</li>
                            <li>location</li>
                            <li>postal_code</li>
                            <li>resume_path</li>
                            <li>cv_path</li>
                            <li>portfolio_path</li>
                            <li>banner_image</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function testRelations() {
            const resultDiv = document.getElementById('relations-result');
            resultDiv.classList.remove('hidden');
            resultDiv.innerHTML = '<p class="text-blue-600">Loading...</p>';

            try {
                const response = await fetch('/test-relations');
                const data = await response.json();
                
                resultDiv.innerHTML = `
                    <h4 class="font-semibold mb-2">Test Results:</h4>
                    <pre class="text-sm">${JSON.stringify(data, null, 2)}</pre>
                `;
            } catch (error) {
                resultDiv.innerHTML = `<p class="text-red-600">Error: ${error.message}</p>`;
            }
        }

        async function showUsersProfiles() {
            const resultDiv = document.getElementById('users-result');
            resultDiv.classList.remove('hidden');
            resultDiv.innerHTML = '<p class="text-green-600">Loading...</p>';

            try {
                const response = await fetch('/show-users-profiles');
                const data = await response.json();
                
                let html = '<h4 class="font-semibold mb-2">Users with Profiles:</h4>';
                
                data.users_with_profiles.forEach(user => {
                    html += `
                        <div class="border-b pb-2 mb-2">
                            <p><strong>${user.name}</strong> (${user.email})</p>
                            <p class="text-sm text-gray-600">
                                Profile: ${user.has_profile ? 'Yes' : 'No'}
                                ${user.profile_data ? `- Location: ${user.profile_data.location || 'N/A'}` : ''}
                            </p>
                        </div>
                    `;
                });
                
                resultDiv.innerHTML = html;
            } catch (error) {
                resultDiv.innerHTML = `<p class="text-red-600">Error: ${error.message}</p>`;
            }
        }
    </script>
</body>
</html>
