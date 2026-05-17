@extends('layouts.app', ['title' => "D'Kampong Dashboard"])

@section('content')
<div class="min-h-screen bg-zinc-950 text-zinc-100">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-white/10 bg-black/40 lg:flex">
            <div class="border-b border-white/10 px-6 py-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 text-lg font-black text-white shadow-lg shadow-red-900/30">
                        DK
                    </div>
                    <div>
                        <p class="text-lg font-bold tracking-wide">D'Kampong</p>
                        <p class="text-sm text-zinc-400">Restaurant Admin</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 space-y-2 px-4 py-6 text-sm">
                <a href="#" class="flex items-center gap-3 rounded-xl bg-gradient-to-r from-orange-500/20 to-red-500/20 px-4 py-3 font-medium text-white ring-1 ring-orange-500/30">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-zinc-300 transition hover:bg-white/5 hover:text-white">
                    <span>🧾</span>
                    <span>Orders</span>
                </a>
                <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-zinc-300 transition hover:bg-white/5 hover:text-white">
                    <span>🍕</span>
                    <span>Menu</span>
                </a>
                <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-zinc-300 transition hover:bg-white/5 hover:text-white">
                    <span>👥</span>
                    <span>Customers</span>
                </a>
                <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-zinc-300 transition hover:bg-white/5 hover:text-white">
                    <span>📊</span>
                    <span>Reports</span>
                </a>
                <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-zinc-300 transition hover:bg-white/5 hover:text-white">
                    <span>⚙️</span>
                    <span>Settings</span>
                </a>
            </nav>

            <div class="border-t border-white/10 p-4">
                <div class="rounded-2xl bg-gradient-to-br from-zinc-900 to-zinc-800 p-4 ring-1 ring-white/10">
                    <p class="text-sm text-zinc-400">Logged in as</p>
                    <p class="mt-1 font-semibold text-white">{{ $user['name'] ?? 'Admin User' }}</p>
                    <p class="text-sm text-zinc-500">{{ $user['email'] ?? 'admin@dkampong.com' }}</p>
                </div>
            </div>
        </aside>

        <main class="flex-1">
            <header class="border-b border-white/10 bg-zinc-950/80 px-6 py-5 backdrop-blur">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-orange-400">D'Kampong</p>
                        <h1 class="mt-1 text-3xl font-bold text-white">Dashboard Overview</h1>
                        <p class="mt-1 text-sm text-zinc-400">Monitor orders, sales, and restaurant activity in one place.</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-zinc-300 md:block">
                            {{ now()->format('d M Y, h:i A') }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-xl bg-gradient-to-r from-red-500 to-orange-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-red-950/30 transition hover:opacity-90">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="space-y-6 p-6">
                <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-3xl border border-orange-500/20 bg-gradient-to-br from-orange-500/15 to-red-500/10 p-5 shadow-lg shadow-orange-950/10">
                        <p class="text-sm text-zinc-300">Today Sales</p>
                        <h2 class="mt-3 text-3xl font-bold text-white">RM 2,480</h2>
                        <p class="mt-2 text-sm text-emerald-400">+12.4% from yesterday</p>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                        <p class="text-sm text-zinc-400">Total Orders</p>
                        <h2 class="mt-3 text-3xl font-bold text-white">126</h2>
                        <p class="mt-2 text-sm text-zinc-400">18 new in the last hour</p>
                    </div>

                    <div class="rounded-3xl border border-red-500/20 bg-red-500/10 p-5">
                        <p class="text-sm text-zinc-300">Pending Orders</p>
                        <h2 class="mt-3 text-3xl font-bold text-white">14</h2>
                        <p class="mt-2 text-sm text-red-300">Needs kitchen attention</p>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                        <p class="text-sm text-zinc-400">Active Customers</p>
                        <h2 class="mt-3 text-3xl font-bold text-white">58</h2>
                        <p class="mt-2 text-sm text-zinc-400">8 repeat customers today</p>
                    </div>
                </section>

                <section class="grid gap-6 xl:grid-cols-3">
                    <div class="xl:col-span-2 rounded-3xl border border-white/10 bg-white/5 p-6">
                        <div class="mb-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-white">Sales Summary</h3>
                                <p class="text-sm text-zinc-400">Weekly performance snapshot</p>
                            </div>
                            <span class="rounded-full bg-orange-500/15 px-3 py-1 text-xs font-medium text-orange-300">This Week</span>
                        </div>

                        <div class="grid h-72 grid-cols-7 items-end gap-3">
                            @php
                                $bars = [45, 72, 58, 88, 64, 95, 78];
                                $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                            @endphp

                            @foreach ($bars as $index => $height)
                                <div class="flex flex-col items-center gap-3">
                                    <div class="flex h-56 w-full items-end">
                                        <div class="w-full rounded-t-2xl bg-gradient-to-t from-red-600 via-orange-500 to-amber-300" style="height: {{ $height }}%;"></div>
                                    </div>
                                    <span class="text-xs text-zinc-500">{{ $days[$index] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                        <div class="mb-5">
                            <h3 class="text-xl font-semibold text-white">Popular Menu</h3>
                            <p class="text-sm text-zinc-400">Best sellers today</p>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between rounded-2xl bg-black/30 px-4 py-3">
                                <div>
                                    <p class="font-medium text-white">Kampong Beef Pizza</p>
                                    <p class="text-sm text-zinc-400">32 orders</p>
                                </div>
                                <span class="text-orange-400">RM 28</span>
                            </div>

                            <div class="flex items-center justify-between rounded-2xl bg-black/30 px-4 py-3">
                                <div>
                                    <p class="font-medium text-white">Spicy Chicken Pizza</p>
                                    <p class="text-sm text-zinc-400">26 orders</p>
                                </div>
                                <span class="text-orange-400">RM 25</span>
                            </div>

                            <div class="flex items-center justify-between rounded-2xl bg-black/30 px-4 py-3">
                                <div>
                                    <p class="font-medium text-white">Cheesy Fries</p>
                                    <p class="text-sm text-zinc-400">19 orders</p>
                                </div>
                                <span class="text-orange-400">RM 12</span>
                            </div>

                            <div class="flex items-center justify-between rounded-2xl bg-black/30 px-4 py-3">
                                <div>
                                    <p class="font-medium text-white">Iced Lemon Tea</p>
                                    <p class="text-sm text-zinc-400">17 orders</p>
                                </div>
                                <span class="text-orange-400">RM 6</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="grid gap-6 xl:grid-cols-3">
                    <div class="xl:col-span-2 rounded-3xl border border-white/10 bg-white/5 p-6">
                        <div class="mb-5 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-white">Recent Orders</h3>
                                <p class="text-sm text-zinc-400">Latest customer transactions</p>
                            </div>
                            <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-zinc-300 hover:bg-white/10">
                                View all
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm">
                                <thead class="text-zinc-400">
                                    <tr class="border-b border-white/10">
                                        <th class="px-3 py-3 font-medium">Order ID</th>
                                        <th class="px-3 py-3 font-medium">Customer</th>
                                        <th class="px-3 py-3 font-medium">Item</th>
                                        <th class="px-3 py-3 font-medium">Amount</th>
                                        <th class="px-3 py-3 font-medium">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-zinc-200">
                                    <tr class="border-b border-white/5">
                                        <td class="px-3 py-4">#DK1024</td>
                                        <td class="px-3 py-4">Aisyah</td>
                                        <td class="px-3 py-4">2x Kampong Beef Pizza</td>
                                        <td class="px-3 py-4">RM 56</td>
                                        <td class="px-3 py-4"><span class="rounded-full bg-amber-500/15 px-3 py-1 text-xs text-amber-300">Preparing</span></td>
                                    </tr>
                                    <tr class="border-b border-white/5">
                                        <td class="px-3 py-4">#DK1023</td>
                                        <td class="px-3 py-4">Hakim</td>
                                        <td class="px-3 py-4">1x Spicy Chicken Pizza</td>
                                        <td class="px-3 py-4">RM 25</td>
                                        <td class="px-3 py-4"><span class="rounded-full bg-red-500/15 px-3 py-1 text-xs text-red-300">Pending</span></td>
                                    </tr>
                                    <tr class="border-b border-white/5">
                                        <td class="px-3 py-4">#DK1022</td>
                                        <td class="px-3 py-4">Farah</td>
                                        <td class="px-3 py-4">1x Cheesy Fries, 2x Drinks</td>
                                        <td class="px-3 py-4">RM 24</td>
                                        <td class="px-3 py-4"><span class="rounded-full bg-emerald-500/15 px-3 py-1 text-xs text-emerald-300">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-4">#DK1021</td>
                                        <td class="px-3 py-4">Daniel</td>
                                        <td class="px-3 py-4">Family Combo Set</td>
                                        <td class="px-3 py-4">RM 82</td>
                                        <td class="px-3 py-4"><span class="rounded-full bg-orange-500/15 px-3 py-1 text-xs text-orange-300">On Delivery</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                            <h3 class="text-xl font-semibold text-white">Quick Actions</h3>
                            <div class="mt-4 grid gap-3">
                                <button class="rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 px-4 py-3 text-sm font-semibold text-white hover:opacity-90">
                                    + New Order
                                </button>
                                <button class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-medium text-zinc-200 hover:bg-white/10">
                                    Update Menu
                                </button>
                                <button class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-medium text-zinc-200 hover:bg-white/10">
                                    View Reports
                                </button>
                            </div>
                        </div>

                        <div class="rounded-3xl border border-red-500/20 bg-red-500/10 p-6">
                            <h3 class="text-xl font-semibold text-white">Low Stock Alert</h3>
                            <ul class="mt-4 space-y-3 text-sm text-zinc-20000">
                                >
                                    <span>Mozzarella Cheese</span>
                                    <span class="text-red-300">Low</span>
                                </l/li>
                                >
                                    <span>Pepperoni</span>
                                    <span class="text-red-300">Low</span>
                                </l/li>
                                >
                                    <span>Pizza Box Large</span>
                                    <span class="text-orange-300">Medium</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>
@endsection