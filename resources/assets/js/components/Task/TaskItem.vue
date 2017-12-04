<template>
	<div>
		
			<h3>{{task.title}} <span class="completed" v-if="task.is_completed">is done!</span></h3>
			<div v-show="!isEditing" class="content">{{ task.content }}</div>
			<textarea v-show="isEditing" class="form-control" v-model="task.content"></textarea>
			<div class="meta">
				<ul class="list-unstyled">
					<li><strong>Created at:</strong> {{ task.created_at }}</li>
					<li v-if="task.updated_at"><strong>Updated at:</strong> {{ task.updated_at }}</li>
					<li v-if="task.is_completed"><strong>Completed at:</strong> {{ task.completed_at }}</li>

					<li v-if="task.is_completed == 0">
						<button v-show="!isEditing" v-on:click="edit" class="btn btn-primary btn-xs">Edit</button>
						<button v-show="isEditing" v-on:click="save(task)" class="btn btn-primary btn-xs">Save</button>
						<button class="btn btn-warning btn-xs" v-on:click="complete(task)">It's Done!</button>
						<button class="btn btn-danger btn-xs" v-on:click="destroy(task)">Delete</button>
					</li>
				</ul>
			</div>
		
	</div>
</template>

<script>
import { HTTP_API } from '../../http-common';

export default {
	data() {
		return {
			isEditing: false
		}
	},

	props: ['task', 'toggleForm'],

	methods: {
		edit: function() {
			this.isEditing = true;
		},

		save: function(task) {
			this.$emit('save', task);
			this.isEditing = this.toggleForm;
		},

		complete: function(task) {
			task.is_completed = 1;
			this.$emit('save', task);
		},

		destroy: function(task) {
			this.$emit('destroy', task);
		}
	}
}
</script>

<style type="text/css">
.meta {
	margin-top: 12px;
	font-size: 12px;
	padding: 6px 12px;
	background: #eee;
	border-radius: 8px;
}

.meta li {
	padding-top: 3px;
}
</style>