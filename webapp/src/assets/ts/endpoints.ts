//@ts-check

// Contains the API endpoints
class Endpoints {
  static filesEndpoint(): string {
    return 'http://www.sistemamargarita-files.com'
  }

  static apiEndpoint(): string {
    return 'http://www.sistemamargarita-api.com'
  }

  static dashboardEndpoint(): string {
    return this.apiEndpoint() + '/dashboard/dashboard.php/'
  }

  static publicEndpoint(): string {
    return this.apiEndpoint() + '/public/public.php/'
  }
}

export { Endpoints }
