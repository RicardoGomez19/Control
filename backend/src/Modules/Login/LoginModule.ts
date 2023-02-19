import { HttpMethod } from "../../App/HttpMethod";
import { Module } from "../../App/Module";
import { RouterController } from "../../App/RouterController";
import { LoginController } from "./LoginController";

export const LoginModule = new Module('/auth', [], [
    new RouterController(HttpMethod.GET, '/login', [], LoginController.login)
])