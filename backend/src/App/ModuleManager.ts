import { Application } from "express"
import { Module } from "./Module"

export abstract class ModuleManager {
    protected abstract getModules(): Module[]
    private appRef: Application
    constructor(app: Application) {
        this.appRef = app
    }
    protected prepareModules() {
        const modules = this.getModules()
        for (let module of modules) {
            this.appRef.use(module.path, module.globalMiddlewares, module.router)
        }
    }
}