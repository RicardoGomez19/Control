import { RequestHandler, Router } from "express"
import { RouterController } from "./RouterController"

export class Module {
    public router = Router()
    constructor(
        public path: string,
        public globalMiddlewares: RequestHandler[],
        private childrens: RouterController[]
    ) {
        for (let controller of this.childrens) {
            this.router[controller.method](controller.path, controller.middlewares, controller.handler)
        }
    }
}