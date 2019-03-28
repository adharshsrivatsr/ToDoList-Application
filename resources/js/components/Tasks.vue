<template>
    <div>
        <b-table  :items="items" :fields="fields" hover  fixed show-empty>
            <template slot='name' slot-scope="{item}">
                     {{item.name}}
            </template>
            
            <template slot='status' slot-scope='{item}'>
                <div v-if="item.status == '0'">
                    <font color='red'>Incomplete</font>
                 </div>
                
                <div v-else>
                    <font color='green'>Complete</font>
                </div>      
            </template>

            <template slot='priority' slot-scope='{item}'>
                <li v-for='prio in item.priorities'>
                    {{prio.priority}} 
                </li>
            </template>

            <template slot=' ' slot-scope='{item}'>
            <button class="button is-primary" @click="editRow">Show more</button>
                 {{showMod}}
            <edit v-show="showMod">{{item.name}}</edit>
            </template>
     
        </b-table>

        <div class="control">
               <button class="button is-primary" v-show="!showInput" @click="addTask" >Add Task</button>
               <div v-show='showInput'>
                    {{showInput}}
                    <form method="POST" action='/tasks' @submit.prevent='onSubmit'>
             
                        <div class='control'>
                            <input type='text' placeholder='Enter task here' name='name' v-model='name' required minlength=3 autocomplete="off"  style='height:30px'>
                        </div>
                        <div class='control'>
                            <input type='checkbox' value='Important'   v-model='priority' > Important <br>
                            <input type='checkbox' value='Urgent' size='22' v-model='priority' /> Urgent <br>
                            <input type='checkbox' value='Ignore' size='22' v-model='priority' /> Ignore <br>
                            <input type='checkbox' value='Optional' size='22' v-model='priority'/> Optional <br>
                        </div>
                        <div class='control'>
                            <button class='button is-primary'>Submit!</button>
                        </div>
                    </form>

                </div>
        </div>
        
    </div>
    
</template>

<script>
    import Edit from './Edit.vue';

    export default {

        components:{Edit},

        data() {
            return {
                items: [],
                showInput:0,
                name:[],
                showMod:0,
                priority:[],
                errors:[],
                edit:0,
                fields:[
                    {
                        key:'name',
                        sortable:true
                    },
                   
                    {
                        key:'priority',
                        sortable:true
                    },
                    {
                        key:'status',
                        sortable:true
                    },
                
                    {
                        key:'updated_at',
                        sortable:true
                    },
                    {
                        key: ' '
                    }     
                ]
            }
        },
        created: function () {
            this.getTasks()
        },
        methods: {
            getTasks: function () {
                axios.get('/tasks')
                    .then(response => {
                        this.items = response.data
                
                    })  
                    
            },

          
            addTask:function() {
               
               this.showInput= !this.showInput
               this.name='';
               
            
            },

            onSubmit:function() {
              
                axios.post('/tasks', this.$data)
                    .catch(error=> this.errors=error.response.data);
                
                window.location.reload();
                this.showInput=0;
                
            },

            editRow: function() {
                this.showMod= 1;
                console.log(this.showMod);
            }
        }
    }
</script>


