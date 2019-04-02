<template>
 <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <div class='control'>
                    <input style="border:none; height:30px" type='text' :readonly="edit==0" v-model="initial_name" required minlength=3 autocomplete="off" >
                      
                </div>
                
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
       
            <div class="modal-body">
                <div v-if="edit==1" class='control'>
                    <input type='checkbox' value='Important' v-model='initial_prio' > Important <br>
                    <input type='checkbox' value='Urgent' size='22' v-model='initial_prio' /> Urgent <br>
                    <input type='checkbox' value='Ignore' size='22' v-model='initial_prio' /> Ignore <br>
                    <input type='checkbox' value='Optional' size='22' v-model='initial_prio'/> Optional <br>
                </div>
            
                <div v-else v-for='p in initial_prio' :key="p">
                    
                        {{p}}
                        
                    </div>
            
            </div>

            <div v-if="edit==0">
            <div v-if="initial_status == '0'">
                <font color='red'>The activity is incomplete!</font>
            </div>
               
            <div v-else>
                <font color='green'>You have completed the activity!</font>
            </div>     
            </div>
            <div v-else>
                <input type="radio" v-model="initial_status" value=0>Incomplete
                <input type="radio" v-model="initial_status" value=1 @click="recordTime">Complete
            </div>
                
        
            <div class="modal-footer">
                <button v-if="edit==0" @click="editVal" class="btn btn-primary"> Edit </button> 
                <button v-if="edit==1" @click="deleteTask" class="btn btn-primary"> Delete </button>
                <button v-if="edit==1" @click="onSubmit" class="btn btn-primary"> Submit </button>  
                
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {
    props:["initial_name","initial_status","initial_prio","edit","initial_id"],

    data() {
    return {
    //    name:"",
    //     id:"",
    time:""
    }
    },
    methods:{
      editVal:function() {
        this.edit=1
       },
    
    onSubmit:function() {
       
           axios.put('/tasks/'+this.initial_id, {
               name:this.initial_name,
               id:this.initial_id,
               priority:this.initial_prio,
               status:this.initial_status,
               });

            window.location.reload();
       },

    deleteTask:function() {
       if(confirm("Are you sure bro?"))
        {
            axios.delete('/tasks/'+this.initial_id);
            window.location.reload();
        }
    },
    
    recordTime:function() {
        this.time=Date();
    }
    
    }
}
</script>

<style>
 
</style>
