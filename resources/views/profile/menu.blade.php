<div class='clear'>
        <a href='/peeps/public/' class='profileMenu'>Listings </a>
    @if ($route_name!="summary")
        <a href='/peeps/public/profile/{{$person_id}}' class='profileMenu'>Summary</a>
    @else 
        <div class='profileMenu activeProfileMenu'>
            Summary
        </div>
    @endif
    @if ($route_name!="characteristics")
        <a href='/peeps/public/profile/{{$person_id}}/characteristics' class='profileMenu'>Characteristics</a>
    @else 
        <div class='profileMenu activeProfileMenu'>
        Characteristics
        </div>
    @endif
    @if ($route_name!="notes")
        <a href='/peeps/public/profile/{{$person_id}}/notes' class='profileMenu'>Notes</a>
    @else 
        <div class='profileMenu activeProfileMenu'>
        Notes
        </div>
    @endif
    @if ($route_name!="network")
        <a href='/peeps/public/profile/{{$person_id}}/network' class='profileMenu'>Social Network</a>
    @else 
        <div class='profileMenu activeProfileMenu'>
        Social Network
        </div>
    @endif
    @if ($route_name!="todo")
        @if (count($to_dos)>0)
            <a href='/peeps/public/profile/{{$person_id}}/todo' class='profileMenu'>To Do (Active)</a>
        @elseif (count($to_dos)==0)
            <a href='/peeps/public/profile/{{$person_id}}/todo' class='profileMenu'>To Do</a>
        @endif
    @else 
        <div class='profileMenu activeProfileMenu'>
        To Do
        </div>
    @endif
</div>
