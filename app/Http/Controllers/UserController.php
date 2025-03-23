namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('register');
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'password' => 'required',
        ]);

        $user = User::find($request->id);

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);
            return redirect('/users');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }

    // List Users
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    // Delete User
    public function delete($id)
    {
        User::destroy($id);
        return redirect('/users')->with('success', 'User deleted successfully.');
    }

    // Show Edit Form
    public function edit($id)
    {
        $user = User::find($id);
        return view('edit', compact('user'));
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
        ]);

        $user->update($request->only(['username', 'email', 'phone']));

        return redirect('/users')->with('success', 'User updated successfully.');
    }
}

