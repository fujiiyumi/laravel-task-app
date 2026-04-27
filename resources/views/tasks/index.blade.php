<table border="1">
    <tr>
        <th>ID</th>
        <th>タイトル</th>
        <th>内容</th>
        <th>編集</th>
    </tr>
    @foreach($tasks as $task)
    <tr>
        <td>{{$task->id}}</td>
        <td>{{$task->title}}</td>
        <td>{{$task->content}}</td>
        <td>
            <a href="{{route('tasks.edit',$task->id)}}">編集</a>
        </td>
    </tr>
    @endforeach
</table>