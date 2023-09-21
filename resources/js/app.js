import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

// Echo.private('classroom.'+classroomId)// specify the channel
// .listen('.classwork-created',function(event){// sepcify the event
//    alert(event.title)
// });

if(classroomId)
{
Echo.private('classroom.' + classroomId)
// App\Events\classwork-created //الباث يلي بيفترضه ،بس احنا عملنا aliase
.listen('.classwork-created', function(event) {
    alert(event.title);
});
}
Echo.private('Notifcations'+ userId)
.notification(function (event){
    alert(event.body);
});
