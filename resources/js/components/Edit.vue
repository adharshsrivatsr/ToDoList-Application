<template>
 <div id="showModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
               <div v-if="edit==0" class='control'>
                    <input style="border:none; height:40px; font-weight:bold" size='30' type="text" id="input" readonly v-model="initial_name" autocomplete="off">
                 </div>

                <div v-if="edit==1" class='control'>
                    
                    <form class="form-horizontal">
                    <div class="form-group has-warning has-feedback">
                      <div class="col-sm-10">
                          <b> Edit task name: </b> 
                            <input type="text" v-model="initial_name" autocomplete="off">
                        </div>
                    </div>
                    </form>
                </div>
                <button type="button" class="close" data-dismiss="modal"  @click="edit=0">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
       
            <div class="modal-body">
                <div v-if="edit==1" class='control'>
                     <div class="jumbotron" style="text-align:left">
                        <b>Choose priority information : </b> <br>
                        <input type='checkbox' value='Urgent' size='22' v-model='initial_prio'/> Urgent </br>
                        <input type='checkbox' value='Important' v-model='initial_prio' > Important <br>
                        <input type='checkbox' value='Optional' size='22' v-model='initial_prio'/> Optional <br>
                        <input type='checkbox' value='Ignore' size='22' v-model='initial_prio' /> Ignore <br>
                        </div>
                </div>
            
               <div v-else>
                  <b v-for='p in initial_prio' :key="p">
                        <span v-if="p=='Urgent'" class="badge badge-danger">Urgent</span>
                        <span v-if="p=='Important'" class="badge badge-warning">Important</span>
                        <span v-if="p=='Optional'" class="badge badge-info">Optional</span> 
                        <span v-if="p=='Ignore'" class="badge badge-secondary">Ignore</span>
                    </b>
                </div>

                <br>

                <div class="alert alert-info" v-if="edit==0">
                    <i class="fa fa-clock-o" style="font-size:26px"></i> The task was recently updated on {{updated_at}} 
                </div>
            
            </div>

            <div v-if="edit==0">
                <div v-if="initial_status == '0'" class="alert alert-danger">
                    The activity is incomplete!
                </div>
                
                <div v-else class="alert alert-success">
                    <font color='green'>You completed this activity on  {{completed_at}}!</font>
                </div>     
            </div>

            <div v-else>
                <div class="container">
                    <b style="align:left"> Change status : </b>
                </div>
                <div class="custom-control custom-switch" style="text-align:center">
                  
                    <input type="checkbox" size="42" class="custom-control-input" v-model="initial_status" @click="recordTime" id="switch1">
                    <label class="custom-control-label" v-if="initial_status==0" for="switch1"><b style="color:red"> Incomplete </b></label>
                    <label class="custom-control-label" v-if="initial_status==1" for="switch1"><b style="color:green">Complete</b></label>
                </div>
            </div>
                
        
            <div class="modal-footer">
                <button v-if="edit==0" @click="editVal" class="btn btn-primary" > Edit </button> 
                <button v-if="edit==1" @click="deleteTask" class="btn btn-danger"> Delete </button>
                <button v-if="edit==1" @click="onSubmit" class="btn btn-success"> Submit </button>  
                
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {
    props:["initial_name","initial_status","initial_prio","edit","initial_id","completed_at","updated_at"],

    data() {
    return {
        time:"",
    }
    },
    methods:{
        
        getTasks: function () {
                
                axios.get('/tasks')
                    .then(response => {
                        this.items = response.data
                  })
         },  
           
        editVal:function() {
            this.edit=1
            document.getElementById("input").style.border="1px solid red"
            console.log(document.getElementById("input").style.border)
        },
    
        onSubmit:function() {
       
           if(this.initial_status == 0) {
                this.time=null
            }
            
            if(this.initial_name.length <3)
            {
                alert('Task name should have atleast 3 characters!')
                return;
            }
          
            if (this.initial_prio.length==0) {
                alert('Choose atleast one priority!!')
                return;
            }

            axios.put('/tasks/'+this.initial_id, {
               name:this.initial_name,
               id:this.initial_id,
               time:this.time,
               priority:this.initial_prio,
               status:this.initial_status,
               }); 
                // this.showModal=false;
                // this.getTasks();
               window.location.reload();
                // $('#showModal').modal('hide');
        },

        deleteTask:function() {
            if(confirm("Are you sure bro?"))
            {
                axios.delete('/tasks/'+this.initial_id);
            
            }
            this.showModal=false;
            // this.getTasks();
            window.location.reload();
    },
    
    recordTime:function() {
        this.time=Date();
    }
    
    }
}
</script>

<style>
 
</style>
