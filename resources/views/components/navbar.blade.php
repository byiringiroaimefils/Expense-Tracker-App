<nav style="display: flex; justify-content: space-between; margin: 5px;">
    <div>
        <h3>Logo</h3>
    </div>
    <div>
        <ul style="display: flex; justify-content: space-between; gap: 30px;">
            <li style=" list-style: none"><a style="font-size: 20px;  text-decoration: none; color: black;" href="/dashboard"
                    class="hover:underline">Home</a></li>
            <li style="list-style: none"><a style="font-size: 20px;;text-decoration: none; color: black;" href="/transaction"
                    class="hover:underline">Transactions</a></li>
            <li style="list-style: none"><a style="font-size: 20px;;text-decoration: none ; color: black;" href="/report"
                    class="hover:underline">Report</a></li>
        </ul>
    </div>
    <div style="margin-right:20px ">
        <p><a style="text-decoration: none ; color: red;" href="{{ route('register.logout') }}">Log Out</a></p>
    </div>
</nav>
