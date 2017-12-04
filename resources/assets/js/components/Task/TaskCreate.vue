<template>
	<div>
		<button class="btn btn-default" v-show="!isCreating" v-on:click="showForm">Add New Task</button>
		<form v-show="isCreating">
			<h3>Creating New Task...</h3>
			<div class="form-group">
				<input placeholder="title" type="text" class="form-control" v-model="title">
			</div>
			<div class="form-group">
				<textarea placeholder="content" class="form-control" v-model="content"></textarea>
			</div>
			<div class="form-group">
				<button v-on:click="create" class="btn-primary btn-xs">Create</button>
				<button class="btn-default btn-xs" v-on:click="cancel">Cancel</button>
			</div>
		</form>
	</div>
</template>

<script>
import { HTTP_API } from '../../http-common';

export default {
	data() {
		return {
			title: '',
			content: '',
			isCreating: false
		}
	},

	props: ['toggleForm'],

	methods: {
		showForm: function() {
			this.isCreating = true
		},

		cancel: function(e) {
			e.preventDefault();
			
			this.isCreating = false;
			this.title = '';
			this.content = '';
		},

		create: function(e) {
			e.preventDefault();

			let task = {
				title: this.title,
				content: this.content
			};

			this.$emit('create', task);
			this.isCreating = this.toggleForm;
		}
	}
}
</script>