<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タスク一覧
            </h2>

            <a href="{{ route('tasks.create') }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                ＋新規登録
            </a>
        </div>
    </x-slot>

    <form action="{{route('tasks.index')}}" method="get">
        <input type="text" name="keyword" value="{{request('keyword')}}" placeholder="タイトル検索">
        <select name="status">
            <option value="">すべて</option>
            <option value="未着手"@selected(request('status')==='未着手')>未着手</option>
            <option value="進行中"@selected(request('status')==='進行中')>進行中</option>
            <option value="完了" @selected(request('status')==='完了')>完了</option>
        </select>
        <select name="sort">
            <option value="">並び替え</option>
            <option value="latest"@selected(request('sort')==='latest')>新しい順</option>
            <option value="oldest" @selected(request('sort')==='oldest')>古い順</option>
        </select>
        <button type="submit">検索</button>
    </form>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">タイトル</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">コンテント</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ステータス</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $task->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $task->content }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $task->status }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('tasks.edit', $task) }}"
                                           class="px-3 py-1 text-sm bg-amber-500 text-white rounded-md hover:bg-amber-600 transition">
                                            編集
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                                                    onclick="return confirm('本当に削除しますか?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$tasks->links()}}

            </div>
        </div>
    </div>
</x-app-layout>