<template>
	<div>
		<div class="nav">
			<button v-on:click="loadFiltered(0)" class="btn btn-default">
				Show me incompleted stuffs...
			</button>			

			<button v-on:click="loadFiltered(1)" class="btn btn-default">
				Show me completed stuffs...
			</button>

			<button v-show="filteredLoaded" v-on:click="loadData()" class="btn btn-default">
				Show me all stuffs...
			</button>
		</div>

		<hr/>

		<task-create 
			:toggle-form="isCreating" 
			v-on:create="create">
		</task-create>

		<hr/>
		
		<task-item 
			class="task-item" 
			v-for="task in tasks" 
			v-on:save="save" 
			v-on:complete="save" 
			v-on:destroy="destroy"
			:task="task"
			:toggle-form="isEditing" 
			:key="task.id">
		</task-item>
		
	</div>
</template>

<script>
	
import { HTTP_API } from '../../http-common';
import TaskItem from './TaskItem';
import TaskCreate from './TaskCreate';

export default {
	data() {
        return {
            tasks: [],
            isEditing: false,
            isCreating: false,
            filteredLoaded: false
        }
   	},

   	components: {
    	TaskItem,
    	TaskCreate
  	},

   	methods: {
   		loadData: function() {
			HTTP_API.get('tasks').then(response=>{
				this.tasks = response.data;
				this.filteredLoaded = false;
			}).catch(error=>{

			});
   		},

   		loadFiltered: function(filter) {
   			let params = {
   				params: {
   					is_completed: filter
   				}
   			};

			HTTP_API.get('tasks', params).then(response=>{
				this.tasks = response.data;
				this.filteredLoaded = true;
			}).catch(error=>{

			});
   		},

   		create: function(task) {
			HTTP_API.post('tasks', task).then(response=>{
				this.loadData();
   				this.isCreating = false;
			}).catch(error=>{
				this.isCreating = true;
			});
   		},

   		save: function(task) {
			HTTP_API.put('tasks/'+task.id, task).then(response=>{
				this.loadData();
				this.isEditing = false;
			}).catch(error=>{
				this.isEditing = true;
			});
   		},

   		destroy: function(task) {
			HTTP_API.delete('tasks/'+task.id).then(response=>{
				this.loadData();
			}).catch(error=>{
				
			}); 			
   		}
   	},

   	mounted() {
   		this.loadData();
   	}
}
</script>

<style type="text/css">
.task-item {
	margin-bottom: 12px;
	padding-bottom: 12px;
	border-bottom: 1px solid #eee;
}

.task-item textarea {
	display: block;
}

.meta ul {
	list-style-type: none;
}

.nav {
	margin-bottom: 12px;
}
</style>