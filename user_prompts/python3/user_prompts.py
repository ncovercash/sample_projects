#!/usr/bin/python3

name = input("Name: ")
age = input("Age: ")
username = input("Username: ")

if username.find("u/") == 0:
	username = "/"+username

if username.find("/u/") == -1:
	username = "/u/"+username

print("Your name is "+name+", you are "+age+" years old, and your username is "+username+"\n")
